<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\http,
	estvoyage\risingsun\output
;

class stream
	implements http\route
{
	private
		$stream
	;

	function __construct(output\stream $stream)
	{
		$this->stream = $stream;
	}

	function recipientOfHttpResponseForRequestIs(http\request $request, http\response\recipient $recipient)
	{
		$recipient->httpResponseIs(new http\response\stream($this->stream));

		return $this;
	}

	function recipientOfHttpUrlPathIs(http\url\path\recipient $recipient)
	{
	}
}
