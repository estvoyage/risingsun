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

	function recipientOfHttpResponseForRequestIs(http\request $request, http\response\recipient $recipient)
	{
		$request
			->recipientOfHttpMethodIs(
				new class($this->method, $this->route, $request, $recipient)
					implements
						http\method\recipient
				{
					function __construct(http\method $method, http\route $route, http\request $request, http\response\recipient $recipient)
					{
						$this->method = $method;
						$this->route = $route;
						$this->recipient = $recipient;
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
											$this->route->recipientOfHttpResponseForRequestIs($this->request, $this->recipient);
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
