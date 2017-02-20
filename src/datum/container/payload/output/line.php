<?php namespace estvoyage\risingsun\datum\container\payload\output;

use estvoyage\risingsun\{ datum\container\payload, ointeger, container\iterator\controller, output, datum };

class line
	implements
		payload
{
	private
		$output,
		$operation
	;

	function __construct(output $output, datum\operation\binary $operation)
	{
		$this->output = $output;
		$this->operation = $operation;
	}

	function containerIteratorControllerForDatumAtPositionIs(datum $datum, ointeger $position, controller $controller)
	{
		$this->output
			->outputLineIsOperationOnData(
				$this->operation,
				$position,
				$datum
			)
		;

		return $this;
	}
}
