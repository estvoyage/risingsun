<?php namespace estvoyage\risingsun\output\stream\formater;

use
	estvoyage\risingsun\output
;

class stream implements output\stream\formater
{
	private
		$stream
	;

	function __construct(output\stream $stream)
	{
		$this->stream = $stream;
	}

	function outputIs(output $output)
	{
		$output->outputStreamIs($this->stream);

		return $this;
	}
}
