<?php namespace estvoyage\risingsun\ostring\pattern;

use
	estvoyage\risingsun
;

interface controller
{
	function stringMatchPattern(match $match, risingsun\ostring\pattern $pattern);
	function stringContainsPatternData(match $match, risingsun\hash $hash);
}
