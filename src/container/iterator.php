<?php namespace estvoyage\risingsun\container;

interface iterator
{
	function payloadForContainerValuesIs(array $values, payload $payload);
}
