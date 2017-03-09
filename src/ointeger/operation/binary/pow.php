<?php namespace estvoyage\risingsun\ointeger\operation\binary;

use estvoyage\risingsun\{ ointeger, ninteger, block };

class pow extends any
{
	function __construct(block $overflow = null)
	{
		parent::__construct(new ninteger\operation\binary\pow($overflow));
	}
}
