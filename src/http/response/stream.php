<?php namespace estvoyage\risingsun\http\response;

use
	estvoyage\risingsun\http,
	estvoyage\risingsun\output
;

class stream
	implements
		http\response
{
	private
		$stream
	;

	function __construct(output\stream $stream)
	{
		$this->stream = $stream;
	}

	function recipientOfHttpResponseBodyIsOutput(output $output)
	{
		$output->outputStreamIs($this->stream);

		return $this;
	}
}
