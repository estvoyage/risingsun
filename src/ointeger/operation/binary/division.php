<?php namespace estvoyage\risingsun\ointeger\operation\binary;

use estvoyage\risingsun\{ ninteger, block };

class division extends any
{
	function __construct(block $divisionByZero = null)
	{
		parent::__construct(new ninteger\operation\binary\division($divisionByZero));
	}
}
