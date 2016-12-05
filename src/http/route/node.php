<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\iterator
;

class node
	implements
		http\route
{
	private
		$collection
	;

	function __construct(http\route... $routes)
	{
		$this->collection = new http\route\collection(... $routes);
	}

	function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
	{
		$this
			->collection
				->payloadForIteratorIs(
					new iterator\fifo,
					new block\functor(
						function($iterator, $route) use ($controller, $request) {
							$route->httpRouteControllerHasRequest(
								new class($iterator, $controller)
									implements http\route\controller
								{
									private
										$iterator,
										$controller
									;

									function __construct(risingsun\iterator $iterator, http\route\controller $controller)
									{
										$this->iterator = $iterator;
										$this->controller = $controller;
									}

									function httpResponseIs(http\response $response)
									{
										$this->iterator->nextIteratorValuesAreUseless();

										$this->controller->httpResponseIs($response);
									}
								},
								$request
							);
						}
					)
				)
		;

		return $this;
	}

	function recipientOfHttpUrlPathIs(http\url\path\recipient $recipient)
	{
	}
}
