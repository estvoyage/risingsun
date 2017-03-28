<?php namespace estvoyage\risingsun\ointeger\comparison\binary;

use estvoyage\risingsun\{ oboolean, comparison };

class equal extends any
{
	function __construct(oboolean $ok = null, oboolean $ko = null)
	{
		parent::__construct(new comparison\binary\equal($ok, $ko));
	}
}
