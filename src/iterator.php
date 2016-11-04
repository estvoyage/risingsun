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
		$run
	;

	function __construct(... $values)
	{
		$this->values = $values;
		$this->run = new oboolean\wrong;
	}

	function iteratorPayloadIs(iterator\payload $payload)
	{
		$_this = clone $this;
		$_this->run = new oboolean\right;

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
		$this->run
			->ifTrue(
				new block\functor(
					function() {
						$this->break = true;
					}
				)
			)
		;

		return $this;
	}
}
