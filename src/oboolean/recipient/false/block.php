<?php namespace estvoyage\risingsun\oboolean\recipient\false;

use estvoyage\{ risingsun, risingsun\oboolean };

class block
	implements
		oboolean\recipient
{
	private
		$block
	;

	function __construct(risingsun\block $block)
	{
		$this->block = $block;
	}

	function obooleanIs(oboolean $oboolean)
	{
		$oboolean
			->blockForFalseIs(
				$this->block
			)
		;

		return $this;
	}
}
