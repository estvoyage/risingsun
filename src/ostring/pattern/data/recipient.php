<?php namespace estvoyage\risingsun\ostring\pattern\data;

use
	estvoyage\risingsun
;

interface recipient
{
	function hashContainsPatternDataFromString(risingsun\hash $hash, risingsun\ostring $string);
}
