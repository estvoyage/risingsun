<?php namespace estvoyage\risingsun\output\stream;

use
	estvoyage\risingsun\output
;

interface aggregator
{
	function outputIs(output $output);
	function outputStreamIs(output\stream $stream);
}
