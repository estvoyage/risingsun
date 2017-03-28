<?php namespace estvoyage\risingsun\ofloat\comparison\unary;

use estvoyage\risingsun\{ ofloat, oboolean };

class lessThan extends any
{
	function __construct(ofloat $reference = null, oboolean $ok = null, oboolean $ko = null)
	{
		parent::__construct(new ofloat\comparison\binary\lessThan($ok, $ko), $reference);
	}
}
