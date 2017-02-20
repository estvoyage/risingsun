<?php namespace estvoyage\risingsun\output\formater;

use estvoyage\risingsun\{ output, datum, block\functor };

class pair
{
	private
		$firstDatum,
		$secondDatum,
		$operation
	;

	function __construct(datum $firstDatum, datum $secondDatum, datum\operation\binary $operation)
	{
		$this->firstDatum = $firstDatum;
		$this->secondDatum = $secondDatum;
		$this->operation = $operation;
	}

	function outputIs(output $output)
	{
		$output->outputLineIsOperationOnData(
			$this->operation,
			$this->firstDatum,
			$this->secondDatum
		);

		return $this;
	}
}
