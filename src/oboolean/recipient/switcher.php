<?php namespace estvoyage\risingsun\oboolean\recipient;

use estvoyage\risingsun\{ oboolean, block };

class switcher
	implements
		oboolean\recipient
{
	private
		$ok,
		$ko
	;

	function __construct(block $ok, block $ko)
	{
		$this->ko = $ko;
		$this->ok = $ok;
	}

	function obooleanIs(oboolean $oboolean)
	{
		$oboolean->blockForFalseIs($this->ko);
		$oboolean->blockForTrueIs($this->ok);

		return $this;
	}
}
