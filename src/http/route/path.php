<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean
;

class path
	implements
		http\route
{
	private
		$path,
		$route
	;

	function __construct(http\url\path $path, http\route $route)
	{
		$this->path = $path;
		$this->route = $route;
	}

	function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
	{
		$request->recipientOfHttpUrlPathIs(
			new class($this->path, $this->route, $controller, $request)
				implements
					http\url\path\recipient
			{
				private
					$path,
					$route,
					$controller,
					$request
				;

				function __construct(http\url\path $path, http\route $route, http\route\controller $controller,  http\request $request)
				{
					$this->path = $path;
					$this->route = $route;
					$this->controller = $controller;
					$this->request = $request;
				}

				function httpUrlPathIs(http\url\path $path)
				{
					$this
						->path
							->ifIsEqualToHttpUrlPath(
								$path,
								new block\functor(
									function() {
										$this->request
											->recipientOfHttpRequestWithoutHeadUrlPathIs(
												$this->path,
												new class($this->route, $this->controller)
													implements
														http\request\recipient
												{
													private
														$route,
														$controller
													;

													function __construct(http\route $route, http\route\controller $controller)
													{
														$this->route = $route;
														$this->controller = $controller;
													}

													function httpRequestIs(http\request $request)
													{
														$this->route
															->httpRouteControllerHasRequest(
																$this->controller,
																$request
															)
														;
													}
												}
											)
										;
									}
								)
							)
					;
				}
			}
		);

		return $this;
	}

	function recipientOfHttpUrlPathIs(http\url\path\recipient $recipient)
	{
		$recipient->httpUrlPathIs($this->path);

		return $this;
	}
}
