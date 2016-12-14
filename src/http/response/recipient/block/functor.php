<?php namespace estvoyage\risingsun\http\response\recipient\block;

use
	estvoyage\risingsun\http,
	estvoyage\risingsun\block
;

class functor
	implements
		http\response\recipient
{
	private
		$block
	;

	function __construct(block $block)
	{
		$this->block = $block;
	}

	function httpResponseIs(http\response $response)
	{
		$this->block->blockArgumentsAre($response);

		return $this;
	}
}
