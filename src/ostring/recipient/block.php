<?php namespace estvoyage\risingsun\ostring\recipient;

use
	estvoyage\risingsun,
	estvoyage\risingsun\ostring
;

class block
	implements
		ostring\recipient
{
	private
		$block
	;

	function __construct(risingsun\block $block)
	{
		$this->block = $block;
	}

	function ostringIs(ostring $string)
	{
		$this->block->blockArgumentsAre($string);

		return $this;
	}
}
