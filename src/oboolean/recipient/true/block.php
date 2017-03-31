<?php namespace estvoyage\risingsun\oboolean\recipient\true;

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
			->blockForTrueIs(
				$this->block
			)
		;

		return $this;
	}
}
