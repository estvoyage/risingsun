<?php namespace estvoyage\risingsun\ointeger\operation\unary;

use estvoyage\risingsun\{ ointeger\operation, ointeger };

class addition
	implements
		operation\unary
{
	private
		$addend
	;

	function __construct(ointeger $addend)
	{
		$this->addend = $addend;
	}

	function recipientOfOperationWithOIntegerIs(ointeger $ointeger, ointeger\recipient $recipient)
	{
		$ointeger
			->recipientOfOIntegerOperationWithOIntegerIs(
				new operation\binary\addition,
				$this->addend,
				$recipient
			)
		;

		return $this;
	}
}
