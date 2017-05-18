<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\ointeger;

class equal extends any
{
	function __construct(ointeger $reference)
	{
		parent::__construct(new ointeger\comparison\binary\equal, $reference);
	}
}
