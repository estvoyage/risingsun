<?php namespace estvoyage\risingsun\comparison\unary\container;

use estvoyage\risingsun\{ comparison\unary as comparison, container };

interface iterator
{
	function unaryComparisonsForPayloadAre(payload $payload, comparison... $comparisons) :void;
}
