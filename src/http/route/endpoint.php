<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\http
;

class endpoint
	implements
		http\route
{
	private
		$response
	;

	function __construct(http\response $response)
	{
		$this->response = $response;
	}

	function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
	{
		$controller->httpResponseIs($this->response);

		return $this;
	}

	function recipientOfHttpUrlPathIs(http\url\path\recipient $recipient)
	{
		return $this;
	}
}
