<?php namespace estvoyage\risingsun\datum\operation\unary;

use estvoyage\risingsun\{ datum\operation, datum, nstring, ostring, block\functor };

class pipe
	implements
		operation\unary
{
	private
		$operations
	;

	function __construct(operation\unary... $operations)
	{
		$this->operations = $operations;
	}

	function recipientOfOperationWithDatumIs(datum $datum, nstring\recipient $recipient)
	{
		$currentDatum = $datum;

		foreach ($this->operations as $operation)
		{
			$operation->recipientOfOperationWithDatumIs(
				$currentDatum,
				new functor(
					function($nstring) use (& $currentDatum)
					{
						$currentDatum = new ostring\any($nstring);
					}
				)
			);
		}

		$currentDatum->recipientOfNStringIs($recipient);

		return $this;
	}

	function recipientOfOperationIs(nstring\recipient $recipient)
	{
		return $this->recipientOfOperationWithDatumIs(
			new ostring\any,
			$recipient
		);
	}
}
