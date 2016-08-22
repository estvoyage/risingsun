<?php namespace estvoyage\risingsun;

use
	estvoyage\risingsun,
	estvoyage\risingsun\block
;

class iterator
{
	private
		$values,
		$break,
		$breakHandler
	;

	function __construct(... $values)
	{
		$this->values = $values;
		$this->breakHandler = new risingsun\blackhole;
	}

	function iteratorPayloadIs(iterator\payload $payload)
	{
		$_this = clone $this;
		$_this->breakHandler = new block\functor(function() use ($_this) {
				$_this->break = true;
			}
		);

		foreach ($_this->values as $value)
		{
			$payload->currentValueOfIteratorIs($_this, $value);

			if ($_this->break)
			{
				break;
			}
		}

		return $this;
	}

	function nextIteratorValuesAreUseless()
	{
		$this->breakHandler->blockArgumentsAre();

		return $this;
	}
}
