<?php namespace estvoyage\risingsun\datum\container;

use estvoyage\risingsun\{ datum, datum\container\payload };

interface iterator
{
	function dataForPayloadAre(payload $payload, datum... $data);
}
