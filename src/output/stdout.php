<?php namespace estvoyage\risingsun\output;

use
	estvoyage\risingsun\output
;

class stdout
	implements
		output
{
	function endOfLine()
	{
		echo PHP_EOL;

		return $this;
	}

	function outputStreamIs(output\stream $stream)
	{
		echo $stream;

		return $this;
	}
}
