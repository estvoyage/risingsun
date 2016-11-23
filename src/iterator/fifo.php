<?php namespace estvoyage\risingsun\iterator;

use
	estvoyage\risingsun
;

class fifo
	implements
		risingsun\iterator
{
	private
		$values
	;

	function iteratorPayloadForValuesIs(array $values, payload $payload)
	{
		$_this = clone $this;
		$_this->values = \splFixedArray::fromArray($values);

		foreach ($values as $value)
		{
			$payload->currentValueOfIteratorIs($_this, $value);

			if (! $_this->values)
			{
				break;
			}
		}

		return $this;
	}

	function nextIteratorValuesAreUseless()
	{
		$this->values = null;

		return $this;
	}
}
