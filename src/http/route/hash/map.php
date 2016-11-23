<?php namespace estvoyage\risingsun\http\route\hash;

use
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\hash,
	estvoyage\risingsun\iterator
;

class map
	implements
		http\route\hash
{
	private
		$hash
	;

	function __construct(http\route... $routes)
	{
		(
			new class(new hash\map, new block\functor(function($hash) { $this->hash = $hash; }))
				implements
					hash\recipient,
					http\url\path\recipient
			{
				private
					$hash,
					$block,
					$route
				;

				function __construct(hash\map $hash, block $block)
				{
					$this->hash = $hash;
					$this->block = $block;
				}

				function httpRoutesAre(http\route... $routes)
				{
					(new iterator\fifo)
						->iteratorPayloadForValuesIs(
							$routes,
							new block\functor(
								function($iterator, $route) {
									$this->route = $route;

									$this->route->recipientOfHttpUrlPathIs($this);
								}
							)
						)
					;

					$this->block->blockArgumentsAre($this->hash);
				}

				function httpUrlPathIs(http\url\path $path)
				{
					$this->hash->recipientOfHashWithValueIs(new hash\value\withKey($this->route, new hash\key(http\url\path::toString($path))), $this);
				}

				function hashIs(hash $hash)
				{
					$this->hash = $hash;
				}
			}
		)
			->httpRoutesAre(...$routes);
		;
	}

	function recipientOfHttpRouteWithPathIs(http\url\path $path, http\route\hash\route\recipient $recipient)
	{
		$this
			->hash
				->recipientOfHashValueAtKeyIs(
					new hash\key(http\url\path::toString($path)),
					new class($recipient)
						implements
							hash\value\recipient
					{
						private
							$recipient
						;

						function __construct(http\route\hash\route\recipient $recipient)
						{
							$this->recipient = $recipient;
						}

						function hashKeyHasValue($value)
						{
							$this->recipient->httpRouteWithPathIs($value);
						}
					}
				)
		;

		return $this;
	}

	function recipientOfHttpRouteHashWithRouteIs(http\route $route, http\route\hash\recipient $recipient)
	{
		$route
			->recipientOfHttpUrlPathIs(
				new class($route, $this->hash, new block\functor(function($hash) use ($recipient) { $_this = clone $this; $_this->hash = $hash; $recipient->httpRouteHashIs($_this); }))
					implements
						hash\recipient,
						http\url\path\recipient
				{
					private
						$route,
						$hash,
						$block
					;

					function __construct(http\route $route, hash $hash, block $block)
					{
						$this->route = $route;
						$this->hash = $hash;
						$this->block = $block;
					}

					function httpUrlPathIs(http\url\path $path)
					{
						$this->hash->recipientOfHashWithValueIs(new hash\value\withKey($this->route, new hash\key(http\url\path::toString($path))), $this);
					}

					function hashIs(hash $hash)
					{
						$this->block->blockArgumentsAre($hash);
					}
				}
			)
		;

		return $this;
	}

	function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
	{
		$request
			->recipientOfHttpUrlPathIs(
				new class($this->hash, $controller, $request)
					implements
						hash\value\recipient,
						http\url\path\recipient
				{
					private
						$hash,
						$controller,
						$request
					;

					function __construct(hash $hash, http\route\controller $controller, http\request $request)
					{
						$this->hash = $hash;
						$this->controller = $controller;
						$this->request = $request;
					}

					function httpUrlPathIs(http\url\path $path)
					{
						$this->hash->recipientOfHashValueAtKeyIs(new hash\key(http\url\path::toString($path)), $this);
					}

					function hashKeyHasValue($value)
					{
						$value->httpRouteControllerHasRequest($this->controller, $this->request);
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
