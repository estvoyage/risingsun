<?php namespace estvoyage\risingsun\http\method\recipient;

use estvoyage\{ risingsun, risingsun\http };

class block
	implements
		http\method\recipient
{
	private
		$block
	;

	function __construct(risingsun\block $block)
	{
		$this->block = $block;
	}

	function httpMethodIs(http\method $method)
	{
		$this->block->blockArgumentsAre($method);

		return $this;
	}
}
