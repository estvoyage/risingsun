<?php namespace estvoyage\risingsun\output;

use
	estvoyage\risingsun
;

class blackhole implements risingsun\output
{
	function outputStreamIs(stream $stream)
	{
		return $this;
	}

	function lineIsOutputStream(stream $stream)
	{
		return $this;
	}

	function endOfLine()
	{
		return $this;
	}
}
