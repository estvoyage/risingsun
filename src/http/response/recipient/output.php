<?php namespace estvoyage\risingsun\http\response\recipient;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http
;

class output
	implements
		http\response\recipient
{
	private
		$output
	;

	function __construct(risingsun\output $output)
	{
		$this->output = $output;
	}

	function httpResponseIs(http\response $response)
	{
		$response->outputIs($this->output);

		return $this;
	}
}
