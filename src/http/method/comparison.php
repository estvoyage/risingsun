<?php namespace estvoyage\risingsun\http\method;

use estvoyage\risingsun\http\method;

interface comparison
{
	function referenceForComparisonWithHttpMethodIs(method $httpMethod, method $reference);
}
