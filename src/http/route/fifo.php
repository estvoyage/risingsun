<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun,
	estvoyage\risingsun\hash,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean
;

class fifo
	implements
		http\route,
		http\route\controller
{
	private
		$routes,
		$iterator,
		$controller
	;

	function __construct(http\route... $routes)
	{
		$this->routes = new risingsun\iterator(... $routes);
	}

	function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
	{
		$_this = clone $this;

		$_this->controller = $controller;

		$_this->routes
			->iteratorPayloadIs(
				new block\functor(
					function($iterator, $route) use ($_this, $request) {
						$_this->iterator = $iterator;

						$route->httpRouteControllerHasRequest($_this, $request);
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

	function httpResponseIs(http\response $response)
	{
		oboolean::isNotNull($this->controller, $this->iterator)
			->ifTrue(
				new block\functor(
					function() use ($response) {
						$this->iterator->nextIteratorValuesAreUseless();

						$this->controller->httpResponseIs($response);

						$this->controller = null;
					}
				)
			)
		;

		return $this;
	}
}
