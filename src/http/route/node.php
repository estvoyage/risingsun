<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\iterator
;

class node
	implements
		http\route
{
	private
		$iterator,
		$collection
	;

	function __construct(iterator $iterator, http\route... $routes)
	{
		$this->iterator = $iterator;
		$this->collection = new http\route\collection(... $routes);
	}

	function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
	{
		$this
			->collection
				->payloadForIteratorIs(
					$this->iterator,
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

									function __construct(iterator $iterator, http\route\controller $controller)
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
