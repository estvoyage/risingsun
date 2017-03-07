<?php namespace estvoyage\risingsun\comparison\binary\container;

use estvoyage\risingsun\{ comparison\binary as comparison, container };

interface iterator
{
	function binaryComparisonsForPayloadAre(payload $payload, comparison... $comparisons);
}
