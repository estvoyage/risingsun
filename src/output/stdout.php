<?php namespace estvoyage\risingsun\output;

use estvoyage\risingsun\{ output, ostring, block\functor, datum };

class stdout
	implements
		output
{
	function nstringIs(string $nstring)
	{
		echo $nstring;

		return $this;
	}

	function endOfLine()
	{
		return $this->nstringIs(PHP_EOL);
	}

	function outputLineIs(string $line)
	{
		return $this
			->nstringIs($line)
			->endOfLine()
		;
	}

	function outputLineIsOperationOnData(datum\operation $operation, datum $firstDatum, datum $secondDatum)
	{
		$operation->recipientOfOperationOnDataIs(
			$firstDatum,
			$secondDatum,
			new functor(
				function($operation)
				{
					$this->outputLineIs($operation);
				}
			)
		);

		return $this;
	}
}
