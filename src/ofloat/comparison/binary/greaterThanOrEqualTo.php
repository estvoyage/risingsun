<?php namespace estvoyage\risingsun\ofloat\comparison\binary;

use estvoyage\risingsun\{ ofloat, block, comparison };

class greaterThanOrEqualTo extends lessThan
{
	function __construct(block $ok, block $ko = null)
	{
		parent::__construct($ko ?: new block\blackhole, $ok);
	}
}
