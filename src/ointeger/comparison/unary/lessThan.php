<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\{ ointeger, block\functor, oboolean, block };

class lessThan extends any
{
	function __construct(ointeger $reference = null)
	{
		parent::__construct($reference ?: new ointeger\any, new ointeger\comparison\binary\lessThan);
	}
}
