<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block
;

class hash
	implements
		http\route,
		http\route\iterator\recipient,
		risingsun\hash\key\recipient
{
	private
		$routes,
		$routeIterator,
		$hashKeyHandler,
		$noHashKeyHandler,
		$routeIteratorHandler,
		$routeNotIndexedHandler
	;

	function __construct(http\route\iterator $routeIterator, http\route... $routes)
	{
		$this->routeIterator = $routeIterator;

		(new risingsun\iterator(... $routes))
			->iteratorPayloadIs(new block\functor(function($iterator, $route) {
						$this->hashKeyHandler = new block\functor(function($key) use ($route) {
								$this->routes[(string) $key] = $route;

								$this->noHashKeyHandler = new risingsun\blackhole;

							}
						);

						$this->noHashKeyHandler = new block\functor(function() use ($route) {
								$this->routeIterator->recipientOfRouteIteratorWithRouteIs($route, $this);
							}
						);

						$this->routeIteratorHandler = new block\functor(function($iterator) {
								$this->routeIterator = $iterator;
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
					= $this->routeIteratorHandler
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
				$_this->routeIterator->httpRouteControllerHasRequest($controller, $request);
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

	function httpRouteIteratorIs(http\route\iterator $iterator)
	{
		$this->routeIteratorHandler->blockArgumentsAre($iterator);

		return $this;
	}
}
