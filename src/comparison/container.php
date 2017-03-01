<?php namespace estvoyage\risingsun\comparison;

use estvoyage\risingsun\container\iterator;

interface container
{
	function controllerOfPayloadForComparisonContainerIteratorIs(container\payload $payload, container\iterator $iterator, iterator\controller $controller);
}
