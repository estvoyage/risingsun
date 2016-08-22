<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun,
	estvoyage\risingsun\hash,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block
;

class fifo
	implements
		http\route,
		http\route\controller
{
	private
		$routes,
		$iterator,
		$responseHandler
	;

	function __construct(http\route... $routes)
	{
		$this->routes = new risingsun\iterator(... $routes);
		$this->responseHandler = new risingsun\blackhole;
	}

	function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
	{
		$_this = clone $this;

		$_this->responseHandler = new block\functor(function($response) use ($_this, $controller) {
				$_this->iterator->nextIteratorValuesAreUseless();

				$controller->httpResponseIs($response);
			}
		);

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

	function recipientOfHashKeyIs(hash\key\recipient $recipient)
	{
		return $this;
	}

	function httpResponseIs(http\response $response)
	{
		$this->responseHandler->blockArgumentsAre($response);

		return $this;
	}
}
