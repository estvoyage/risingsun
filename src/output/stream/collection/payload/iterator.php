<?php namespace estvoyage\risingsun\output\stream\collection\payload;

use estvoyage\{ risingsun, risingsun\output };

class iterator
	implements
		risingsun\iterator\payload,
		output\stream\collection\payload
{
	private
		$payload
	;

	function __construct(output\stream\collection\payload $payload)
	{
		$this->payload = $payload;
	}

	function currentValueOfIteratorIs(risingsun\iterator $iterator, $value)
	{
		$this->currentStreamOfIteratorIs($iterator, $value);

		return $this;
	}

	function currentStreamOfIteratorIs(risingsun\iterator $iterator, output\stream $stream)
	{
		$this->payload->currentStreamOfIteratorIs($iterator, $stream);

		return $this;
	}
}
