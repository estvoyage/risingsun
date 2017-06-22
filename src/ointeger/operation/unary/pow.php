<?php namespace estvoyage\risingsun\ointeger\operation\unary;

use estvoyage\risingsun\{ ointeger\operation, ointeger, block };

class pow extends any
	implements
		operation\unary
{
	function __construct(ointeger $pow, ointeger $template, block $overflow)
	{
		parent::__construct($pow, new ointeger\operation\binary\pow($template, $overflow));
	}
}
