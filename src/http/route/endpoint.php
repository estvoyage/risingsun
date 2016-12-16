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

	function recipientOfHttpResponseForRequestIs(http\request $request, http\response\recipient $recipient)
	{
		$recipient->httpResponseIs($this->response);

		return $this;
	}

	function recipientOfHttpUrlPathIs(http\url\path\recipient $recipient)
	{
		return $this;
	}
}
