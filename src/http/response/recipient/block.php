<?php namespace estvoyage\risingsun\http\response\recipient;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http
;

class block
	implements
		http\response\recipient
{
	private
		$block
	;

	function __construct(risingsun\block $block)
	{
		$this->block = $block;
	}

	function httpResponseIs(http\response $response)
	{
		$this->block->blockArgumentsAre($response);

		return $this;
	}
}
