<?php namespace estvoyage\risingsun\datum\finder;

use estvoyage\risingsun\ointeger;

interface recipient
{
	function datumIsAtPosition(ointeger $position);
}
