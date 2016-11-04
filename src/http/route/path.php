<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean
;

class path
	implements
		http\route,
		http\response\recipient,
		http\request\url\path\recipient
{
	private
		$path,
		$endpoint,
		$controller,
		$request
	;

	function __construct(http\url\path $path, endpoint $endpoint)
	{
		$this->path = $path;
		$this->endpoint = $endpoint;
	}

	function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
	{
		$_this = clone $this;

		$_this->controller = $controller;
		$_this->request = $request;

		$request->recipientOfHttpRequestUrlPathIs($_this);

		return $this;
	}

	function recipientOfHttpRouteHashKeyIs(http\route\hash\key\recipient $recipient)
	{
		return $this;
	}

	function httpRequestUrlPathIs(http\url\path $path)
	{
		oboolean::isNotNull($this->request)
			->ifTrue(
				new block\functor(
					function() use ($path) {
						$path
							->ifIsEqualToHttpUrlPath(
								$this->path,
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
				)
			)
		;
	}

	function httpResponseIs(http\response $response)
	{
		oboolean::isNotNull($this->controller)
			->ifTrue(
				new block\functor(
					function() use ($response) {
						$this->controller->httpResponseIs($response);
					}
				)
			)
		;
	}
}
