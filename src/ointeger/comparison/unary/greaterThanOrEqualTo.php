<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\{ ointeger, block\functor, oboolean, block };

class greaterThanOrEqualTo extends any
{
	function __construct(ointeger $reference = null, oboolean $ok = null, oboolean $ko = null)
	{
		parent::__construct(new ointeger\comparison\binary\greaterThanOrEqualTo($ok, $ko), $reference);
	}
}
