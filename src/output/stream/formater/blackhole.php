<?php namespace estvoyage\risingsun\output\stream\formater;

use
	estvoyage\risingsun\output
;

class blackhole implements output\stream\formater
{
	function outputIs(output $output)
	{
		return $this;
	}
}
