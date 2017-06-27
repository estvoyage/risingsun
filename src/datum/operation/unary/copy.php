<?php namespace estvoyage\risingsun\datum\operation\unary;

use estvoyage\risingsun\{ datum, nstring };

class copy
	implements
		datum\operation\unary
{
	private
		$template
	;

	function __construct(datum $template)
	{
		$this->template = $template;
	}

	function recipientOfDatumOperationWithDatumIs(datum $datum, datum\recipient $recipient)
	{
		$datum
			->recipientOfNStringIs(
				new nstring\recipient\datum($this->template, $recipient)
			)
		;
	}
}
