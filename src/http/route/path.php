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
		$endpoint
	;

	function __construct(http\url\path $path, endpoint $endpoint)
	{
		$this->path = $path;
		$this->endpoint = $endpoint;
	}

	function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
	{
		$request->recipientOfHttpUrlPathIs(
			new class($this->path, $this->endpoint, $controller, $request)
				implements
					http\response\recipient,
					http\url\path\recipient
			{
				private
					$path,
					$endpoint,
					$controller,
					$request
				;

				function __construct(http\url\path $path, endpoint $endpoint, http\route\controller $controller,  http\request $request)
				{
					$this->path = $path;
					$this->endpoint = $endpoint;
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
										$this->endpoint
											->recipientOfHttpResponseForRequestIs(
												$this->request,
												$this
											)
										;
									}
								)
							)
					;
				}

				function httpResponseIs(http\response $response)
				{
					$this->controller->httpResponseIs($response);
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
