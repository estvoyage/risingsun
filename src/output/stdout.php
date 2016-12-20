<?php namespace estvoyage\risingsun\output;

use
	estvoyage\risingsun\output
;

class stdout
	implements
		output
{
	function outputStreamIs(output\stream $stream)
	{
		echo $stream;

		return $this;
	}
}
