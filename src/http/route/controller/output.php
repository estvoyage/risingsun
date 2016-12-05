<?php namespace estvoyage\risingsun\http\route\controller;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http
;

class output
	implements
		http\route\controller
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
