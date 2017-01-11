<?php namespace estvoyage\risingsun\output\stream\collection;

use estvoyage\risingsun\output;

interface iterator
{
	function streamsForPayloadAre(output\stream\collection\payload $payload, output\stream... $streams);
}
