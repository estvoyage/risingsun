<?php namespace estvoyage\risingsun\ointeger\operation\unary;

use estvoyage\risingsun\{ ointeger, block };

class addition extends any
{
	function __construct(ointeger $addend, ointeger $template, block $overflow = null)
	{
		parent::__construct($addend, new ointeger\operation\binary\addition($template, $overflow));
	}
}
