<?php namespace estvoyage\risingsun\ointeger\operation\unary;

use estvoyage\risingsun\{ ointeger, block };

class addition
	implements
		ointeger\operation\unary
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
		(new ointeger\operation\binary\addition($this->overflow))
			->recipientOfOperationOnOIntegersIs(
				$ointeger,
				$this->addend,
				$recipient
			)
		;

		return $this;
	}
}
