<?php namespace estvoyage\risingsun\ofloat\comparison\binary;

use estvoyage\risingsun\{ ofloat, oboolean, comparison };

class lessThan extends any
{
	function __construct(oboolean $ok = null, oboolean $ko = null)
	{
		parent::__construct(new comparison\binary\lessThan($ok, $ko));
	}
}
