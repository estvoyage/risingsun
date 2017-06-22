<?php namespace estvoyage\risingsun\ointeger\operation\binary;

use estvoyage\risingsun\{ ointeger, ninteger, block };

class pow extends any
{
	function __construct(ointeger $template, block $overflow = null)
	{
		parent::__construct($template, new ninteger\operation\binary\pow($overflow));
	}
}
