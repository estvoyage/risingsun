<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\{http, block, boolean}
;

class directory
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

	function recipientOfHttpResponseForRequestIs(http\request $request, http\response\recipient $recipient)
	{
		$request
			->recipientOfSubRequestOfHttpUrlPathIs(
				$this->path,
				new http\request\recipient\block(
					new block\functor(
						function($request) use ($recipient)
						{
							$this->route
								->recipientOfHttpResponseForRequestIs(
									$request,
									$recipient
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
		$recipient->httpUrlPathIs($this->path);

		return $this;
	}
}
