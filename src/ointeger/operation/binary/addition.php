<?php namespace estvoyage\risingsun\ointeger\operation\binary;

use estvoyage\risingsun\{ block, ninteger };

class addition extends any
{
	function __construct(block $overflow = null)
	{
		parent::__construct(new ninteger\operation\binary\addition($overflow));
	}
}
