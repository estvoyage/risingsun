<?php namespace estvoyage\risingsun\output;

use estvoyage\risingsun\{ output, nstring, datum, ostring };

class stdout
	implements
		output
{
	private
		$eol
	;

	function __construct(datum $eol = null)
	{
		$this->eol = $eol ?: new ostring\any(PHP_EOL);
	}

	function datumIs(datum $datum)
	{
		$datum->recipientOfNStringIs(
			new nstring\recipient\functor(
				function($nstring)
				{
					echo $nstring;
				}
			)
		);

		return $this;
	}

	function endOfLine()
	{
		return $this
			->datumIs($this->eol)
		;
	}

	function outputLineIs(datum $line)
	{
		return $this
			->datumIs($line)
			->endOfLine()
		;
	}

	function outputLineIsOperationOnData(datum\operation\binary $operation, datum $firstDatum, datum $secondDatum)
	{
		$operation->recipientOfDatumOperationOnDataIs(
			$firstDatum,
			$secondDatum,
			new datum\recipient\functor(
				function($operation)
				{
					$this->outputLineIs($operation);
				}
			)
		);

		return $this;
	}
}
