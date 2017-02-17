<?php namespace estvoyage\risingsun\oboolean;

use estvoyage\risingsun\{ oboolean, block };

class ok
	implements
		oboolean
{
	function recipientOfComplementIs(oboolean\recipient $recipient)
	{
		$recipient->obooleanIs(new oboolean\wrong);

		return $this;
	}

	function blockForTrueIs(block $block)
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
