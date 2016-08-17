<?php namespace estvoyage\risingsun\output\stream\formater\abbreviation;

use
	estvoyage\risingsun\output,
	estvoyage\risingsun\output\stream
;

class notAvailable implements stream\formater
{
	function outputIs(output $output)
	{
		$output->outputStreamIs(new output\stream('n/a'));

		return $this;
	}
}
