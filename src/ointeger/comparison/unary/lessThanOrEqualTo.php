<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\{ ointeger, block\functor, oboolean, block };

class lessThanOrEqualTo extends any
{
	function __construct(ointeger $reference = null, oboolean $ok = null, oboolean $ko = null)
	{
		parent::__construct(new ointeger\comparison\binary\lessThanOrEqualTo($ok, $ko), $reference);
	}
}
