<?php namespace estvoyage\risingsun\datum\operation\unary\padding;

use estvoyage\risingsun\{ datum\operation, datum, ointeger };

class right
	implements
		operation\unary
{
	private
		$template,
		$length,
		$padding
	;

	function __construct(datum $template, ointeger\unsigned $length, datum $padding)
	{
		$this->template = $template;
		$this->length = $length;
		$this->padding = $padding;
	}

	function recipientOfDatumOperationWithDatumIs(datum $datum, datum\recipient $recipient)
	{
		(new operation\binary\padding\right($this->template, $this->length))
			->recipientOfDatumOperationOnDataIs(
				$datum,
				$this->padding,
				$recipient
			)
		;

		return $this;
	}
}
