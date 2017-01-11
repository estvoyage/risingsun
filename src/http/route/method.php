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
				new http\method\recipient\block(
					new block\functor(
						function($method) use ($request, $recipient)
						{
							$this
								->method
									->ifIsEqualToHttpMethod(
										$method,
										new block\functor(
											function() use ($request, $recipient)
											{
												$this->route->recipientOfHttpResponseForRequestIs($request, $recipient);
											}
										)
									)
							;
						}
					)
				)
			)
		;

		return $this;
	}

	function recipientOfHttpUrlPathIs(http\url\path\recipient $recipient)
	{
		return $this;
	}
}
