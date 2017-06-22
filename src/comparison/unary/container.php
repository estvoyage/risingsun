<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\container\iterator;

interface container
{
	function payloadForUnaryComparisonContainerIteratorIs(container\iterator $iterator, container\payload $payload) :void;
}
