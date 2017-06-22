<?php namespace estvoyage\risingsun\ointeger\operation\binary;

use estvoyage\risingsun\{ block, ninteger, ointeger };

class addition extends any
{
	function __construct(ointeger $template, block $overflow = null)
	{
		parent::__construct($template, new ninteger\operation\binary\addition($overflow));
	}
}
