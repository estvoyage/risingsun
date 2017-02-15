<?php namespace estvoyage\risingsun\oboolean;

use estvoyage\risingsun\oboolean\ok;

class factory
{
	static function areEquals($firstOperand, $secondOperand)
	{
		return $firstOperand == $secondOperand ? new ok : new ko;
	}

	static function areIdenticals($firstOperand, $secondOperand)
	{
		return $firstOperand === $secondOperand ? new ok : new ko;
	}
}
