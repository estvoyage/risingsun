<?php namespace estvoyage\risingsun\ointeger\operation\binary;

use estvoyage\risingsun\{ ninteger, block, ointeger };

class division extends any
{
	function __construct(ointeger $template, block $divisionByZero = null)
	{
		parent::__construct($template, new ninteger\operation\binary\division($divisionByZero));
	}
}
