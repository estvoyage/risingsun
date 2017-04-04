<?php namespace estvoyage\risingsun\ointeger\comparison\binary;

use estvoyage\risingsun\{ block, comparison };

class lessThanOrEqualTo extends any
{
	function __construct(block $ok, block $ko = null)
	{
		parent::__construct(new comparison\binary\lessThanOrEqualTo($ok, $ko));
	}
}
