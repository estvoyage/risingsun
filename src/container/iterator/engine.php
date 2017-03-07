<?php namespace estvoyage\risingsun\container\iterator;

use estvoyage\risingsun\oboolean;

interface engine
{
	function valuesForContainerIteratorPayloadIs(payload $payload, ... $values);
}
