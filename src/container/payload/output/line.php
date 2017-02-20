<?php namespace estvoyage\risingsun\container\payload\output;

use estvoyage\risingsun\{ container\payload, ointeger, container\iterator\controller, output, datum };

class line
	implements
		payload
{
	private
		$output,
		$operation
	;

	function __construct(output $output, datum\operation $operation)
	{
		$this->output = $output;
		$this->operation = $operation;
	}

	function containerIteratorControllerForValueAtPositionIs($value, ointeger $position, controller $controller)
	{
		$this->output
			->outputLineIsOperationOnData(
				$this->operation,
				$position,
				$value
			)
		;

		return $this;
	}
}
