<?php namespace estvoyage\risingsun\comparison\binary;

use estvoyage\risingsun\container\iterator;

interface container
{
	function payloadForBinaryComparisonContainerIteratorIs(container\iterator $iterator, container\payload $payload);
}
