<?php namespace estvoyage\risingsun\output\stream\collection\iterator;

use estvoyage\{ risingsun, risingsun\output };

class fifo
	implements
		output\stream\collection\iterator
{
	private
		$iterator
	;

	function __construct(risingsun\iterator $iterator)
	{
		$this->iterator = $iterator;
	}

	function streamsForPayloadAre(output\stream\collection\payload $payload, output\stream... $streams)
	{
		$this->iterator->iteratorPayloadForValuesIs($streams, new output\stream\collection\payload\iterator($payload));

		return $this;
	}
}
