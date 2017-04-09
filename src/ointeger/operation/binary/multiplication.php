<?php namespace estvoyage\risingsun\ointeger\operation\binary;

use estvoyage\risingsun\{ ninteger, block };

class multiplication extends any
{
	function __construct(block $overflow = null)
	{
		parent::__construct(new ninteger\operation\binary\multiplication($overflow));
	}
}
