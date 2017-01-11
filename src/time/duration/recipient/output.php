<?php namespace estvoyage\risingsun\time\duration\recipient;

use estvoyage\{ risingsun, risingsun\time };
;

class output
	implements
		time\duration\recipient
{
	private
		$output,
		$formater
	;

	function __construct(risingsun\output $output, risingsun\output\formater\duration $formater)
	{
		$this->output = $output;
		$this->formater = $formater;
	}

	function durationIs(time\duration $duration)
	{
		$this->formater->outputForDurationIs($duration, $this->output);
		return $this;
	}
}
