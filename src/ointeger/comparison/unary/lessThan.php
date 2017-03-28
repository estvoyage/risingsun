<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\{ ointeger, block\functor, oboolean, block };

class lessThan extends any
{
	function __construct(ointeger $reference = null, oboolean $ok = null, oboolean $ko = null)
	{
		parent::__construct(new ointeger\comparison\binary\lessThan($ok, $ko), $reference);
	}
}
