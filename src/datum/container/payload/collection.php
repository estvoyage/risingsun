<?php namespace estvoyage\risingsun\datum\container\payload;

use estvoyage\risingsun\{ datum\container\payload, datum, ointeger, container\iterator\controller };

class collection
	implements
		payload
{
	private
		$payloads
	;

	function __construct(payload... $payloads)
	{
		$this->payloads = $payloads;
	}

	function containerIteratorControllerForDatumAtPositionIs(datum $datum, ointeger $position, controller $controller)
	{
		foreach ($this->payloads as $payload)
		{
			$payload->containerIteratorControllerForDatumAtPositionIs($datum, $position, $controller);
		}

		return $this;
	}
}
