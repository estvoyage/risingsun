<?php namespace estvoyage\risingsun\datum\operation\unary;

use estvoyage\risingsun\container\iterator;

interface container
{
	function payloadForUnaryDatumOperationContainerIteratorIs(container\iterator $iterator, container\payload $payload);
}
