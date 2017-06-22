<?php namespace estvoyage\risingsun\ointeger\operation\unary;

use estvoyage\risingsun\{ ointeger, comparison, block };

class division extends any
{
	function __construct(ointeger $divisor, ointeger $template, block $divisionByZero = null)
	{
		parent::__construct($divisor, new ointeger\operation\binary\division($template, $divisionByZero));
	}
}
