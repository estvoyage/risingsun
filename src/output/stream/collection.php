<?php namespace estvoyage\risingsun\output\stream;

use estvoyage\risingsun\output;

class collection
{
	private
		$streams
	;

	function __construct(output\stream... $streams)
	{
		$this->streams = $streams;
	}

	function payloadForIteratorIs(collection\iterator $iterator, collection\payload $payload)
	{
		$iterator->streamsForPayloadAre($payload, ... $this->streams);

		return $this;
	}
}
