<?php namespace estvoyage\risingsun\oboolean;

use estvoyage\risingsun\oboolean\ok;

class factory
{
	static function areEquals($firstOperand, $secondOperand)
	{
		return self::isTrue($firstOperand == $secondOperand);
	}

	static function areIdenticals($firstOperand, $secondOperand)
	{
		return self::isTrue($firstOperand === $secondOperand);
	}

	static function isTrue(bool $value)
	{
		return $value ? new ok : new ko;
	}
}
