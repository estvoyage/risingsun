<?php namespace estvoyage\risingsun;

interface output
{
	function nstringIs(string $nstring);
	function endOfLine();
	function outputLineIs(string $line);
	function outputLineIsOperationOnData(datum\operation\binary $operation, datum $firstDatum, datum $secondDatum);
}
