<?php namespace estvoyage\risingsun\ointeger\operation\binary;

use estvoyage\risingsun\{ ointeger, ointeger\recipient, ointeger\operation\binary, block\functor, block, ninteger };

class substraction extends any
{
	function __construct(ointeger $template, block $overflow = null)
	{
		parent::__construct($template, new ninteger\operation\binary\substraction($overflow));
	}
}
