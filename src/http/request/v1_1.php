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

	function recipientOfHttpRequestHashKeyIs(http\request\hash\key\recipient $recipient)
	{
		$recipient->httpRequestHasKey(new hash\key(http\url\path::toString($this->path)));

		return $this;
	}

	function recipientOfHttpRequestUrlPathIs(http\request\url\path\recipient $recipient)
	{
		$recipient->httpRequestUrlPathIs($this->path);

		return $this;
	}

	function recipientOfHttpMethodIs(http\method\recipient $recipient)
	{
		$recipient->httpMethodIs($this->method);

		return $this;
	}
}
