<?php namespace estvoyage\risingsun\http\method\comparison;

use estvoyage\risingsun\http\method;

interface binary
{
	function referenceForComparisonWithHttpMethodIs(method $httpMethod, method $reference);
}
