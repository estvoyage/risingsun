<?php namespace estvoyage\risingsun;

interface output
{
	function datumIs(datum $datum);
	function endOfLine();
	function outputLineIs(datum $datum);
	function outputLineIsOperationOnData(datum\operation\binary $operation, datum $firstDatum, datum $secondDatum);
}
