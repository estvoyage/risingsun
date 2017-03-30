<?php namespace estvoyage\risingsun\datum;

interface container
{
	function payloadForDatumContainerIteratorIs(container\iterator $iterator, container\payload $payload);
}
