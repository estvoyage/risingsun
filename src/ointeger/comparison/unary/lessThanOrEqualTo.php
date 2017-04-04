<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\{ ointeger, block };

class lessThanOrEqualTo extends any
{
	function __construct(block $ok, ointeger $reference = null, block $ko = null)
	{
		parent::__construct(new ointeger\comparison\binary\lessThanOrEqualTo($ok, $ko), $reference);
	}
}
