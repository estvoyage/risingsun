<?php namespace estvoyage\risingsun\ointeger\comparison\binary;

use estvoyage\risingsun\{ ointeger, oboolean, block, block\functor, comparison };

class greaterThanOrEqualTo extends any
{
	function __construct(oboolean $ok = null, oboolean $ko = null)
	{
		parent::__construct(new comparison\binary\greaterThanOrEqualTo($ok, $ko));
	}
}
