<?php namespace estvoyage\risingsun\output\formater;

use estvoyage\{ risingsun, risingsun\time };

interface duration
{
	function outputForDurationIs(time\duration $duration, risingsun\output $output);
}
