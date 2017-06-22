<?php namespace estvoyage\risingsun\ointeger\operation\binary;

use estvoyage\risingsun\{ ninteger, block, ointeger };

class multiplication extends any
{
	function __construct(ointeger $template, block $overflow = null)
	{
		parent::__construct($template, new ninteger\operation\binary\multiplication($overflow));
	}
}
