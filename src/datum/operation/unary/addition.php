<?php namespace estvoyage\risingsun\datum\operation\unary;

use estvoyage\risingsun\{ datum\operation, datum, block\functor };

class addition
	implements
		operation\unary
{
	private
		$template,
		$suffix
	;

	function __construct(datum $template, datum $suffix)
	{
		$this->template = $template;
		$this->suffix = $suffix;
	}

	function recipientOfDatumOperationWithDatumIs(datum $datum, datum\recipient $recipient)
	{
		(new operation\binary\addition($this->template))
			->recipientOfDatumOperationOnDataIs(
				$datum,
				$this->suffix,
				$recipient
			)
		;

		return $this;
	}
}
