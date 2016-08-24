<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block
;

class hash
	implements
		http\route,
		http\route\aggregator\recipient,
		risingsun\hash\key\recipient
{
	private
		$routes,
		$routeAggregator,
		$hashKeyHandler,
		$noHashKeyHandler,
		$routeAggregatorHandler,
		$routeNotIndexedHandler
	;

	function __construct(http\route\aggregator $routeAggregator, http\route... $routes)
	{
		$this->routeAggregator = $routeAggregator;

		(new risingsun\iterator(... $routes))
			->iteratorPayloadIs(new block\functor(function($aggregator, $route) {
						$this->hashKeyHandler = new block\functor(function($key) use ($route) {
								$this->routes[(string) $key] = $route;

								$this->noHashKeyHandler = new risingsun\blackhole;

							}
						);

						$this->noHashKeyHandler = new block\functor(function() use ($route) {
								$this->routeAggregator->recipientOfRouteAggregatorWithRouteIs($route, $this);
							}
						);

						$this->routeAggregatorHandler = new block\functor(function($aggregator) {
								$this->routeAggregator = $aggregator;
							}
						);

						$route->recipientOfHashKeyIs($this);

						$this->noHashKeyHandler->blockArgumentsAre();
					}
				)
			)
		;

		$this->hashKeyHandler
			= $this->noHashKeyHandler
				= $this->routeNotIndexedHandler
					= $this->routeAggregatorHandler
						= new risingsun\blackhole
		;
	}

	function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
	{
		$_this = clone $this;

		$_this->hashKeyHandler = new block\functor(function($key) use ($_this, $controller, $request) {
				$key = (string) $key;

				if (isset($_this->routes[$key]))
				{
					$_this->routeNotIndexedHandler = new risingsun\blackhole;

					$_this->routes[$key]->httpRouteControllerHasRequest($controller, $request);
				}
			}
		);

		$_this->routeNotIndexedHandler = new block\functor(function() use ($_this, $controller, $request) {
				$_this->routeAggregator->httpRouteControllerHasRequest($controller, $request);
			}
		);

		$request->recipientOfHashKeyIs($_this);

		$_this->routeNotIndexedHandler->blockArgumentsAre();

		return $this;
	}

	function recipientOfHashKeyIs(risingsun\hash\key\recipient $recipient)
	{
		return $this;
	}

	function hashKeyIs(risingsun\hash\key $key)
	{
		$this->hashKeyHandler->blockArgumentsAre($key);

		return $this;
	}

	function httpRouteAggregatorIs(http\route\aggregator $aggregator)
	{
		$this->routeAggregatorHandler->blockArgumentsAre($aggregator);

		return $this;
	}
}
