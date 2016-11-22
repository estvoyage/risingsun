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
					http\route\hash\key\recipient
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
					(new iterator(... $routes))
						->iteratorPayloadIs(
							new block\functor(
								function($aggregator, $route) {
									$this->route = $route;

									$this->route->recipientOfHttpRouteHashKeyIs($this);
								}
							)
						)
					;

					$this->block->blockArgumentsAre($this->hash);
				}

				function httpRouteHasKey(hash\key $key)
				{
					$this->hash->recipientOfHashWithValueIs(new hash\value\withKey($this->route, $key), $this);
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

	function recipientOfHttpRouteAtKeyIs(hash\key $key, http\route\hash\route\recipient $recipient)
	{
		$this
			->hash
				->recipientOfHashValueAtKeyIs(
					$key,
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
							$this->recipient->hashKeyHasHttpRoute($value);
						}
					}
				)
		;

		return $this;
	}

	function recipientOfHttpRouteHashWithRouteIs(http\route $route, http\route\hash\recipient $recipient)
	{
		$route
			->recipientOfHttpRouteHashKeyIs(
				new class($route, $this->hash, new block\functor(function($hash) use ($recipient) { $_this = clone $this; $_this->hash = $hash; $recipient->httpRouteHashIs($_this); }))
					implements
						hash\recipient,
						http\route\hash\key\recipient
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

					function httpRouteHasKey(hash\key $key)
					{
						$this->hash->recipientOfHashWithValueIs(new hash\value\withKey($this->route, $key), $this);
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
			->recipientOfHttpRequestHashKeyIs(
				new class($this->hash, $controller, $request)
					implements
						hash\value\recipient,
						http\request\hash\key\recipient
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

					function httpRequestHasKey(hash\key $key)
					{
						$this->hash->recipientOfHashValueAtKeyIs($key, $this);
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
}
