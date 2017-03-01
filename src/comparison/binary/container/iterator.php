<?php namespace estvoyage\risingsun\comparison\binary\container;

use estvoyage\risingsun\{ comparison\binary as comparison, container };

interface iterator
{
	function binaryComparisonsForPayloadWithControllerAre(payload $payload, container\iterator\controller $controller, comparison... $comparisons);
}
