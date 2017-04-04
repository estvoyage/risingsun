<?php namespace estvoyage\risingsun\ofloat\comparison\unary;
use estvoyage\risingsun\{ ofloat, block };


class greaterThanOrEqualTo extends lessThan
{
	function __construct(block $ok, ofloat $reference = null, block $ko = null)
	{
		parent::__construct($ko ?: new block\blackhole, $reference, $ok);
	}
}
