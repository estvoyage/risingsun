<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\iterator,
	estvoyage\risingsun\oboolean
;

class fifo
	implements
		http\route
{
	private
		$routes
	;

	function __construct(http\route... $routes)
	{
		$this->routes = $routes;
	}

	function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
	{
		(
			new class(... $this->routes)
				implements
					http\route\controller
			{
				private
					$routes,
					$response
				;

				function __construct(http\route... $routes)
				{
					$this->routes = $routes;
				}

				function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
				{
					(new iterator\fifo)
						->iteratorPayloadForValuesIs(
							$this->routes,
							new block\functor(
								function($iterator, $route) use ($controller, $request) {
									$this->response = null;

									$route
										->httpRouteControllerHasRequest(
											$this,
											$request
										)
									;

									oboolean::isNotNull($this->response)
										->ifTrue(
											new block\functor(
												function() use ($controller, $iterator) {
													$iterator->nextIteratorValuesAreUseless();

													$controller->httpResponseIs($this->response);
												}
											)
										)
									;
								}
							)
						)
					;
				}

				function httpResponseIs(http\response $response)
				{
					$this->response = $response;
				}
			}
		)
			->httpRouteControllerHasRequest($controller, $request)
		;

		return $this;
	}

	function recipientOfHttpUrlPathIs(http\url\path\recipient $recipient)
	{
		return $this;
	}
}
