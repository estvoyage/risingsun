<?php namespace estvoyage\risingsun\comparison\container;

use estvoyage\risingsun\{ comparison, container };

interface iterator
{
	function comparisonsForPayloadWithControllerAre(payload $payload, container\iterator\controller $controller, comparison... $comparisons);
}
