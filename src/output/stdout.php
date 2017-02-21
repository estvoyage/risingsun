<?php namespace estvoyage\risingsun\output;

use estvoyage\risingsun\{ output, block\functor, datum };

class stdout
	implements
		output
{
	function datumIs(datum $datum)
	{
		$datum->recipientOfNStringIs(
			new functor(
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
		echo PHP_EOL;

		return $this;
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
