<?php namespace estvoyage\risingsun\comparison\recipient;

use estvoyage\{ risingsun, risingsun\comparison };

class block
	implements
		comparison\recipient
{
	private
		$block
	;

	function __construct(risingsun\block $block)
	{
		$this->block = $block;
	}

	function nbooleanIs(bool $nboolean)
	{
		$this->block->blockArgumentsAre($nboolean);
	}
}
