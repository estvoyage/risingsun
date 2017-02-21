<?php namespace estvoyage\risingsun\datum\operation\unary;

use estvoyage\risingsun\{ datum\operation, datum, ostring, block\functor };

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

	function recipientOfOperationWithDatumIs(datum $datum, datum\recipient $recipient)
	{
		$currentDatum = $datum;

		foreach ($this->operations as $operation)
		{
			$operation->recipientOfOperationWithDatumIs(
				$currentDatum,
				new functor(
					function($datum) use (& $currentDatum)
					{
						$currentDatum = $datum;
					}
				)
			);
		}

		$recipient->datumIs($currentDatum);

		return $this;
	}

	function recipientOfOperationIs(datum\recipient $recipient)
	{
		return $this->recipientOfOperationWithDatumIs(
			new ostring\any,
			$recipient
		);
	}
}
