<?php namespace estvoyage\risingsun\ointeger\generator\operation;

use estvoyage\risingsun\{ ointeger, ointeger\generator, ointeger\recipient, block\functor };

class binary
	implements
		generator
{
	private
		$current,
		$secondOperand,
		$operation
	;

	function __construct(ointeger $start, ointeger $secondOperand, ointeger\operation\binary $operation)
	{
		$this->current = $start;
		$this->secondOperand = $secondOperand;
		$this->operation = $operation;
	}

	function recipientOfOIntegerIs(recipient $recipient)
	{
		$this->operation
			->recipientOfOperationOnOIntegersIs(
				$this->current,
				$this->secondOperand,
				new functor(
					function($newCurrent) use ($recipient)
					{
						$recipient->ointegerIs($this->current);

						$this->current = $newCurrent;
					}
				)
			)
		;

		return $this;
	}
}
