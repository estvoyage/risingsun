<?php namespace estvoyage\risingsun\iterator;

use
	estvoyage\risingsun
;

class lifo
	implements
		risingsun\iterator
{
	private
		$fifoIterator
	;

	function __construct()
	{
		$this->fifoIterator = new fifo;
	}

	function iteratorPayloadForValuesIs(array $values, payload $payload)
	{
		$this->fifoIterator->iteratorPayloadForValuesIs(array_reverse($values), $payload);

		return $this;
	}

	function nextIteratorValuesAreUseless()
	{
		$this->fifoIterator->nextIteratorValuesAreUseless();

		return $this;
	}
}
