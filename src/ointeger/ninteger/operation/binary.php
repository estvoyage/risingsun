<?php namespace estvoyage\risingsun\ointeger\ninteger\operation;

use estvoyage\risingsun\{ ninteger, ointeger, block };

class binary
{
	private
		$ointeger1,
		$ointeger2,
		$operation
	;

	function __construct(ointeger $ointeger1, ointeger $ointeger2, ninteger\operation\binary $operation)
	{
		$this->ointeger1 = $ointeger1;
		$this->ointeger2 = $ointeger2;
		$this->operation = $operation;
	}

	function recipientOfNIntegerIs(ninteger\recipient $recipient)
	{
		(new ointeger\ninteger\aggregator($this->ointeger1, $this->ointeger2))
			->blockIs(
				new block\functor(
					function($ninteger1, $ninteger2) use ($recipient)
					{
						$this->operation
							->recipientOfOperationOnNIntegersIs(
								$ninteger1,
								$ninteger2,
								$recipient
							)
						;
					}
				)
			)
		;

		return $this;
	}
}
