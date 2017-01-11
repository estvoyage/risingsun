<?php namespace estvoyage\risingsun\ostring\operation\binary;

use
	estvoyage\risingsun
;

class addition
	implements
		risingsun\ostring\operation\binary
{
	function recipientForStringOperandAndStringOperandIs(risingsun\ostring $string1, risingsun\ostring $string2, risingsun\ostring\recipient $recipient)
	{
		(
			new class($recipient)
				implements
					risingsun\ostring\value\recipient
			{
				private

					$string
				;

				function stringValueIs(string $string)
				{
					$this->string .= $string;
				}

				function recipientOfResultOfStringOperatorWithOperandAndOperandIs(risingsun\ostring $string1, risingsun\ostring $string2, risingsun\ostring\recipient $recipient)
				{
					$string1->recipientOfStringValueIs($this);
					$string2->recipientOfStringValueIs($this);

					$recipient->ostringIs(new risingsun\ostring($this->string));
				}
			}
		)
			->recipientOfResultOfStringOperatorWithOperandAndOperandIs($string1, $string2, $recipient)
		;

		return $this;
	}
}
