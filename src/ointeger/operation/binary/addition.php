<?php namespace estvoyage\risingsun\ointeger\operation\binary;

use estvoyage\risingsun\{ ointeger, ointeger\recipient, ointeger\operation\binary, block\functor, block, ninteger };

class addition extends any
	implements
		binary
{
	function __construct(block $overflow = null)
	{
		parent::__construct(new ninteger\operation\binary\addition($overflow));
	}
}
