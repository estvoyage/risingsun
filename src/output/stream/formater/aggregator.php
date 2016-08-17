<?php namespace estvoyage\risingsun\output\stream\formater;

use
	estvoyage\risingsun\output
;

class aggregator
	implements
		output\stream\formater
{
	private
		$formaters
	;

	function __construct(output\stream\formater... $formaters)
	{
		$this->formaters = $formaters;
	}

	function outputIs(output $output)
	{
		foreach ($this->formaters as $formater)
		{
			$formater->outputIs($output);
		}

		return $this;
	}
}
