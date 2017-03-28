<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\{ ointeger, oboolean };

class equal extends any
{
	function __construct(ointeger $reference = null, oboolean $ok = null, oboolean $ko = null)
	{
		parent::__construct(new ointeger\comparison\binary\equal($ok, $ko), $reference);
	}
}
