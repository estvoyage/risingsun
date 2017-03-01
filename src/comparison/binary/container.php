<?php namespace estvoyage\risingsun\comparison\binary;

use estvoyage\risingsun\container\iterator;

interface container
{
	function controllerOfPayloadForBinaryComparisonContainerIteratorIs(container\payload $payload, container\iterator $iterator, iterator\controller $controller);
}
