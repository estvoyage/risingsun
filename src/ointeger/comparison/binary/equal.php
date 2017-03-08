<?php namespace estvoyage\risingsun\ointeger\comparison\binary;

use estvoyage\risingsun\{ ointeger, oboolean, block\functor, comparison };

class equal extends any
{
	function __construct(comparison\binary\equal $equal = null)
	{
		parent::__construct($equal ?: new comparison\binary\equal);
	}
}
