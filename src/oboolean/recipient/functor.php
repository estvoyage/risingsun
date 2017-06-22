<?php namespace estvoyage\risingsun\oboolean\recipient;

use estvoyage\risingsun\{ oboolean, block };

class functor
	implements
		oboolean\recipient
{
	private
		$block
	;

	function __construct(block $block)
	{
		$this->block = $block;
	}

	function obooleanIs(oboolean $oboolean) :void
	{
		$this->block->blockArgumentsAre($oboolean);
	}
}
