<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean
;

class hash
	implements
		http\route,
		http\route\hash\key\recipient,
		http\route\aggregator\recipient,
		http\request\hash\key\recipient,
		risingsun\hash\recipient,
		risingsun\hash\value\recipient
{
	private
		$routeHash,
		$routeAggregator,
		$route,
		$controller,
		$request
	;

	function __construct(http\route\aggregator $routeAggregator, http\route... $routes)
	{
		$this->routeHash = new risingsun\hash\map;
		$this->routeAggregator = $routeAggregator;

		(new risingsun\iterator(... $routes))
			->iteratorPayloadIs(
				new block\functor(
					function($aggregator, $route) {
						$this->route = $route;

						$this->route->recipientOfHttpRouteHashKeyIs($this);

						oboolean::isNotNull($this->route)
							->ifTrue(
								new block\functor(
									function() {
										$this->routeAggregator->recipientOfRouteAggregatorWithRouteIs($this->route, $this);
									}
								)
							)
						;
					}
				)
			)
		;

		$this->routeShouldBeNull();
	}

	function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
	{
		$_this = clone $this;

		$_this->controller = $controller;
		$_this->request = $request;

		$request->recipientOfHttpRequestHashKeyIs($_this);

		oboolean::isNotNull($_this->controller, $_this->request)
			->ifTrue(
				new block\functor(
					function() use ($_this) {
						$_this->routeAggregator->httpRouteControllerHasRequest($_this->controller, $_this->request);
					}
				)
			)
		;

		return $this;
	}

	function recipientOfHttpRouteHashKeyIs(http\route\hash\key\recipient $recipient)
	{
		return $this;
	}

	function httpRouteHasKey(risingsun\hash\key $key)
	{
		oboolean::isNotNull($this->route)
			->ifTrue(
				new block\functor(
					function() use ($key) {
						$this->routeHash->recipientOfHashWithValueIs(new risingsun\hash\value\withKey($this->route, $key), $this);

						$this->routeShouldBeNull();
					}
				)
			)
		;
	}

	function httpRequestHasKey(risingsun\hash\key $key)
	{
		oboolean::isNotNull($this->request)
			->ifTrue(
				new block\functor(
					function() use ($key) {
						$this->routeHash->recipientOfHashValueAtKeyIs($key, $this);
					}
				)
			)
		;
	}

	function httpRouteAggregatorIs(http\route\aggregator $aggregator)
	{
		oboolean::isNotNull($this->route)
			->ifTrue(
				new block\functor(
					function() use ($aggregator) {
						$this->routeAggregator = $aggregator;
					}
				)
			)
		;

		return $this;
	}

	function hashIs(risingsun\hash $hash)
	{
		oboolean::isNotNull($this->route)
			->ifTrue(
				new block\functor(
					function() use ($hash) {
						$this->routeHash = $hash;
					}
				)
			)
		;

		return $this;
	}

	function hashHasValue($value)
	{
		oboolean::isNotNull($this->controller, $this->request)
			->ifTrue(
				new block\functor(
					function() use ($value) {
						$value->httpRouteControllerHasRequest($this->controller, $this->request);
					}
				)
			)
		;

		return $this;
	}

	private function routeShouldBeNull()
	{
		$this->route = null;
	}
}
