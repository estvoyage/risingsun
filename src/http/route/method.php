<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\hash,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block
;

class method
	implements
		http\route
{
	private
		$method,
		$route
	;

	function __construct(http\method $method, http\route $route)
	{
		$this->method = $method;
		$this->route = $route;
	}

	function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
	{
		$request
			->recipientOfHttpMethodIs(
				new class($this->method, $this->route, $controller, $request)
					implements
						http\method\recipient
				{
					function __construct(http\method $method, http\route $route, http\route\controller $controller, http\request $request)
					{
						$this->method = $method;
						$this->route = $route;
						$this->controller = $controller;
						$this->request = $request;
					}

					function httpMethodIs(http\method $method)
					{
						$this
							->method
								->ifIsEqualToHttpMethod(
									$method,
									new block\functor(
										function()
										{
											$this->route->httpRouteControllerHasRequest($this->controller, $this->request);
										}
									)
								)
						;
					}
				}
			)
		;

		return $this;
	}

	function recipientOfHttpUrlPathIs(http\url\path\recipient $recipient)
	{
		return $this;
	}
}
