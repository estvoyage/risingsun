<?php namespace estvoyage\risingsun\ofloat\comparison;

use estvoyage\risingsun\ofloat;

interface binary
{
	function referenceForComparisonWithOFloatIs(ofloat $ofloat, ofloat $reference);
}
