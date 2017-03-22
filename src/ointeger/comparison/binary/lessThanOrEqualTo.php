<?php namespace estvoyage\risingsun\ointeger\comparison\binary;

use estvoyage\risingsun\{ ointeger, oboolean, block\functor, comparison };

class lessThanOrEqualTo extends any
{
	function __construct(oboolean $ok = null, oboolean $ko = null)
	{
		parent::__construct(new comparison\binary\lessThanOrEqualTo($ok ?: new oboolean\ok, $ko ?: new oboolean\ko));
	}
}
