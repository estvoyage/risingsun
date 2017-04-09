<?php namespace estvoyage\risingsun\ointeger\operation\binary;

use estvoyage\risingsun\{ ointeger, ointeger\recipient, ointeger\operation\binary, block\functor, block, ninteger };

class substraction extends any
{
	function __construct(block $overflow = null)
	{
		parent::__construct(new ninteger\operation\binary\substraction($overflow));
	}
}
