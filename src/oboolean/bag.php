<?php namespace estvoyage\risingsun\oboolean;

use estvoyage\risingsun\{ oboolean, comparison };

class bag
	implements
		oboolean
{
	private
		$value
	;

	function __construct(bool $value = null)
	{
		$this->value = $value;
	}

	function recipientOfNBooleanIs(comparison\recipient $recipient) :void
	{
		(new comparison\unary\not(new comparison\unary\with\null\type))
			->recipientOfComparisonWithOperandIs(
				$this->value,
				new comparison\recipient\functor\ok(
					function() use ($recipient)
					{
						$recipient->nbooleanIs($this->value);
					}
				)
			)
		;
	}

	function recipientOfOBooleanWithNBooleanIs(bool $nboolean, oboolean\recipient $recipient) :void
	{
		$self = clone $this;
		$self->value = $nboolean;

		$recipient->obooleanIs($self);
	}
}
