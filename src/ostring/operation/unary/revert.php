<?php namespace estvoyage\risingsun\ostring\operation\unary;

use estvoyage\risingsun;

class revert
	implements
		risingsun\ostring\operation\unary
{
	function recipientForStringOperandIs(risingsun\ostring $operand, risingsun\ostring\recipient $recipient)
	{
		$operand->recipientOfStringValueIs(
			new class($recipient)
				implements
					risingsun\ostring\value\recipient
			{
				private
					$recipient
				;

				function __construct(risingsun\ostring\recipient $recipient)
				{
					$this->recipient = $recipient;
				}

				function stringValueIs(string $value)
				{
					$this->recipient->ostringIs(new risingsun\ostring(strrev($value)));
				}
			}
		);

		return $this;
	}
}
