<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\http,
	estvoyage\risingsun\block
;

class leaf
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

	function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
	{
		$request
			->recipientOfHttpUrlPathIs(
				new class(
					new block\functor(
						function($path) use ($controller, $request)
						{
							$this->path
								->ifIsEqualToHttpUrlPath(
									$path,
									new block\functor(
										function() use ($controller, $request) {
											$this->route->httpRouteControllerHasRequest($controller, $request);
										}
									)
								)
							;
						}
					)
				)
					implements
						http\url\path\recipient
				{
					private
						$block
					;

					function __construct(block $block)
					{
						$this->block = $block;
					}

					function httpUrlPathIs(http\url\path $path)
					{
						$this->block->blockArgumentsAre($path);
					}
				}
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
