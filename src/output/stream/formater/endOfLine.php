<?php namespace estvoyage\risingsun\output\stream\formater;

use
	estvoyage\risingsun\output
;

class endOfLine implements output\stream\formater
{
	function outputIs(output $output)
	{
		$output->endOfLine();

		return $this;
	}
}
