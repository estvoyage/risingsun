<?php namespace estvoyage\risingsun\datum\operation\unary\container;

use estvoyage\risingsun\datum\operation\unary as operation;

interface iterator
{
	function unaryDatumOperationsForPayloadAre(payload $payload, operation... $operations) :void;
}
