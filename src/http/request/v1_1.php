<?php namespace estvoyage\risingsun\http\request;

use
	estvoyage\risingsun\hash,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block
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

	function recipientOfSubRequestOfHttpUrlPathIs(http\url\path $path, recipient $recipient)
	{
		$this->path
			->recipientOfHttpUrlPathWithoutHeadIs(
				$path,
				new class(
					new block\functor(
						function($path) use ($recipient)
						{
							$_this = clone $this;
							$_this->path = $path;

							$recipient->httpRequestIs($_this);
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
}
