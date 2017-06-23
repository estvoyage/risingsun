<?php namespace estvoyage\risingsun\datum\operation\binary;

use estvoyage\risingsun\{ datum, nstring, ostring };

class join
	implements
		datum\operation\binary
{
	private
		$template,
		$glue
	;

	function __construct(datum $template, datum $glue)
	{
		$this->template = $template;
		$this->glue = $glue;
	}

	function recipientOfDatumOperationOnDataIs(datum $firstOperand, datum $secondOperand, datum\recipient $recipient)
	{
		(new datum\operation\unary\addition(new ostring\any, $this->glue))
			->recipientOfDatumOperationWithDatumIs(
				$firstOperand,
				new datum\recipient\functor(
					function($firstOperand) use ($secondOperand, $recipient)
					{
						(new datum\operation\unary\addition($this->template, $secondOperand))
							->recipientOfDatumOperationWithDatumIs(
								$firstOperand,
								$recipient
							)
						;
					}
				)
			)
		;
	}
}
