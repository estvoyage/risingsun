<?php namespace estvoyage\risingsun\container\iterator;

interface engine
{
	function valuesForContainerIteratorPayloadIs(payload $payload, ... $values);
}
