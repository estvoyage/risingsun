<?php namespace estvoyage\risingsun\oboolean;

use estvoyage\risingsun\{ oboolean, block };

class ko
	implements
		oboolean
{
	function recipientOfComplementIs(oboolean\recipient $recipient)
	{
		$recipient->obooleanIs(new oboolean\right);

		return $this;
	}

	function blockForTrueIs(block $block)
	{
		return $this;
	}
}