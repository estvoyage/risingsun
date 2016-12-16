<?php namespace estvoyage\risingsun\http\route\controller;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http
;

class block
	implements
		http\route\controller
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
