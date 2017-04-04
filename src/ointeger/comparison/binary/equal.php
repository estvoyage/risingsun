<?php namespace estvoyage\risingsun\ointeger\comparison\binary;

use estvoyage\risingsun\{ block, comparison };

class equal extends any
{
	function __construct(block $ok, block $ko = null)
	{
		parent::__construct(new comparison\binary\equal($ok, $ko));
	}
}
