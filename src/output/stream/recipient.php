<?php namespace estvoyage\risingsun\output\stream;

use
	estvoyage\risingsun\output
;

interface recipient
{
	function outputStreamIs(output\stream $stream);
}
