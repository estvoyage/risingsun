<?php namespace estvoyage\risingsun\ointeger\comparison\binary;

use estvoyage\risingsun\{ block, comparison };

class lessThan extends any
{
	function __construct(block $ok, block $ko = null)
	{
		parent::__construct(new comparison\binary\lessThan($ok, $ko));
	}
}
