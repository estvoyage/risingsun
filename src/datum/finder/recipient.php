<?php namespace estvoyage\risingsun\datum\finder;

use estvoyage\risingsun\datum;

interface recipient
{
	function datumIsAtPosition(datum\length $position);
}
