<?php namespace estvoyage\risingsun\output;

use
	estvoyage\risingsun
;

class stream extends risingsun\ostring
{
	function outputStreamIs(self $stream)
	{
		return new self($this . $stream);
	}
}
