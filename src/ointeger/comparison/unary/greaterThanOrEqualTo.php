<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\ointeger;

class greaterThanOrEqualTo extends any
{
	function __construct($reference)
	{
		parent::__construct(new ointeger\comparison\binary\greaterThanOrEqualTo, $reference);
	}
}
