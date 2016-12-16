<?php namespace estvoyage\risingsun\http\request\recipient;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http
;

class block
	implements
		http\request\recipient
{
	private
		$block
	;

	function __construct(risingsun\block $block)
	{
		$this->block = $block;
	}

	function httpRequestIs(http\request $request)
	{
		$this->block->blockArgumentsAre($request);

		return $this;
	}
}
