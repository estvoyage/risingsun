<?php namespace estvoyage\risingsun\oboolean;

use estvoyage\risingsun\{ oboolean, block };

class ko
	implements
		oboolean
{
	function recipientOfComplementIs(oboolean\recipient $recipient)
	{
		$recipient->obooleanIs(new oboolean\ok);

		return $this;
	}

	function blockForTrueIs(block $block)
	{
		return $this;
	}

	function blockForFalseIs(block $block)
	{
		$block->blockArgumentsAre();

		return $this;
	}

	function recipientOfOBooleanWithValueIs(bool $value, recipient $recipient)
	{
		$recipient->obooleanIs(factory::isTrue($value));

		return $this;
	}
}
