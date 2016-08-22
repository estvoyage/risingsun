<?php namespace estvoyage\risingsun\iterator;

use
	estvoyage\risingsun
;

interface payload
{
	function currentValueOfIteratorIs(risingsun\iterator $iterator, $value);
}
