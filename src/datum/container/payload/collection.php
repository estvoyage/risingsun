<?php namespace estvoyage\risingsun\datum\container\payload;

use estvoyage\risingsun\{ datum\container\payload, datum, ointeger, container\iterator\engine\controller };

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

	function containerIteratorEngineControllerForDatumAtPositionIs(datum $datum, ointeger $position, controller $controller)
	{
		foreach ($this->payloads as $payload)
		{
			$payload->containerIteratorEngineControllerForDatumAtPositionIs($datum, $position, $controller);
		}

		return $this;
	}
}
