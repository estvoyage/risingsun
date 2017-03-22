<?php namespace estvoyage\risingsun\ointeger\comparison\binary;

use estvoyage\risingsun\{ ointeger, oboolean, block\functor, comparison };

class lessThan extends any
{
	function __construct(comparison\binary\lessThan $lessThan = null)
	{
		parent::__construct($lessThan ?: new comparison\binary\lessThan);
	}
}
