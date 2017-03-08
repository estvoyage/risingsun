<?php namespace estvoyage\risingsun\ointeger\comparison\binary;

use estvoyage\risingsun\{ ointeger, oboolean, block\functor, comparison };

class lessThanOrEqualTo extends any
{
	function __construct(comparison\binary\lessThanOrEqualTo $lessThanOrEqualTo = null)
	{
		parent::__construct($lessThanOrEqualTo ?: new comparison\binary\lessThanOrEqualTo);
	}
}
