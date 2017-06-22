<?php namespace estvoyage\risingsun\time\duration;

use estvoyage\risingsun\{ output, time\duration };

interface formater
{
	function outputForDurationIs(duration $duration, output $output) :void;
}
