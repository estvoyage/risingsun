<?php namespace estvoyage\risingsun\oboolean\recipient;

use estvoyage\risingsun\{ oboolean, block };

class switching
	implements
		oboolean\recipient
{
	private
		$ok,
		$ko
	;

	function __construct(block $ok, block $ko)
	{
		$this->ok = $ok;
		$this->ko = $ko;
	}

	function obooleanIs(oboolean $oboolean)
	{
		$oboolean->blockForFalseIs($this->ko);
		$oboolean->blockForTrueIs($this->ok);

		return $this;
	}
}
