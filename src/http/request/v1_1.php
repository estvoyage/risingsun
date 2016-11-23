<?php namespace estvoyage\risingsun\http\request;

use
	estvoyage\risingsun\hash,
	estvoyage\risingsun\http
;

class v1_1
	implements
		http\request
{
	private
		$method,
		$path
	;

	function __construct(http\method $method, http\url\path $path)
	{
		$this->method = $method;
		$this->path = $path;
	}

	function recipientOfHttpUrlPathIs(http\url\path\recipient $recipient)
	{
		$recipient->httpUrlPathIs($this->path);

		return $this;
	}

	function recipientOfHttpMethodIs(http\method\recipient $recipient)
	{
		$recipient->httpMethodIs($this->method);

		return $this;
	}
}
