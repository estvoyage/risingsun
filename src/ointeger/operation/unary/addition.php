<?php namespace estvoyage\risingsun\ointeger\operation\unary;

use estvoyage\risingsun\{ ointeger\operation, ointeger, block };

class addition
	implements
		operation\unary
{
	private
		$addend
	;

	function __construct(ointeger $addend, block $overflow = null)
	{
		$this->addend = $addend;
		$this->overflow = $overflow ?: new block\blackhole;
	}

	function recipientOfOperationWithOIntegerIs(ointeger $ointeger, ointeger\recipient $recipient)
	{
		$ointeger
			->recipientOfOIntegerOperationWithOIntegerIs(
				new operation\binary\addition($this->overflow),
				$this->addend,
				$recipient
			)
		;

		return $this;
	}
}
