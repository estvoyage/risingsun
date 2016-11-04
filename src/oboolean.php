<?php namespace estvoyage\risingsun;

abstract class oboolean
{
	abstract function ifTrue(block $block);
	abstract function ifFalse(block $block);

	static function newInstance($variable, ... $variables)
	{
		return self::arrayContainsAtLeastOneValueIdenticalTo(func_get_args(), false) ? new oboolean\wrong : new oboolean\right;
	}

	static function keyIsInArray($key, array $array)
	{
		return self::newInstance(isset($array[(string) $key]));
	}

	static function isNotNull($variable, ... $variables)
	{
		return self::arrayContainsValuesNotIdenticalTo(func_get_args(), null);
	}

	static function isFalse($variable, ... $variables)
	{
		return self::arrayContainsOnlyValueIdenticalTo(func_get_args(), false);
	}

	static function isTrue($variable, ... $variables)
	{
		return self::arrayContainsOnlyValueIdenticalTo(func_get_args(), true);
	}

	static function isNotFalse($variable, ... $variables)
	{
		return self::arrayContainsValuesNotIdenticalTo(func_get_args(), false);
	}

	static function throwException(block $block)
	{
		try
		{
			$block->blockArgumentsAre();
		}
		catch (\exception $exception) {}

		return self::newInstance(isset($exception));
	}

	static function isZero($variable, ... $variables)
	{
		return self::isIdentical(0, $variable, ... $variables);
	}

	static function isNotZero($variable, ... $variables)
	{
		return self::arrayContainsValuesNotIdenticalTo(func_get_args(), 0);
	}

	static function isIdentical($reference, $variable, ... $variables)
	{
		return self::arrayContainsOnlyValueIdenticalTo(array_slice(func_get_args(), 1), $reference);
	}

	static function isEqual($reference, $variable, ... $variables)
	{
		return self::arrayContainsOnlyValueEqualTo(array_slice(func_get_args(), 1), $reference);
	}

	static function isNumeric($variable, ... $variables)
	{
		return self::arrayHasSameSizeThan(func_get_args(), array_filter(func_get_args(), [ 'self', 'variableIsNumeric' ]));
	}

	static function isNotNumeric($variable, ... $variables)
	{
		return self::complement(self::isNumeric($variable, ...$variables));
	}

	static function isString($variable, ... $variables)
	{
		return self::arrayHasSameSizeThan(func_get_args(), array_filter(func_get_args(), function($variable) { return is_string($variable) || method_exists($variable, '__toString'); }));
	}

	static function isInteger($variable, ... $variables)
	{
		return self::arrayHasSameSizeThan(func_get_args(), array_filter(func_get_args(), function($variable) { return self::variableIsNumeric($variable) && (int) $variable == $variable; }));
	}

	static function isEmptyString($variable, ... $variables)
	{
		return self::isIdentical('', $variable, ... $variables);
	}

	static function isNotEmptyString($variable, ... $variables)
	{
		return self::newInstance(! self::arrayContainsAtLeastOneValueIdenticalTo(func_get_args(), ''));
	}

	static function complement(self $boolean)
	{
		$boolean
			->ifTrue(
				new block\functor(
					function() use (& $boolean) {
						$boolean = self::newInstance(false);
					}
				)
			)
			->ifFalse(
				new block\functor(
					function() use (& $boolean) {
						$boolean = self::newInstance(true);
					}
				)
			)
		;

		return $boolean;
	}

	static function generateError(block $block)
	{
		$error = self::newInstance(false);

		(new block\executor($block))
			->errorManagerIs(
				new block\functor(
					function() use (& $error) {
						$error = self::newInstance(true);
					}
				)
			)
		;

		return $error;
	}

	private static function arrayContainsOnlyValue(array $variables, $reference, $strict)
	{
		return self::arrayHasSameSizeThan(array_keys($variables, $reference, $strict), $variables);
	}

	private static function arrayContainsOnlyValueEqualTo(array $variables, $reference)
	{
		return self::arrayContainsOnlyValue($variables, $reference, false);
	}

	private static function arrayContainsOnlyValueIdenticalTo(array $variables, $reference)
	{
		return self::arrayContainsOnlyValue($variables, $reference, true);
	}

	private static function arrayContainsValuesNotIdenticalTo(array $variables, $reference)
	{
		return self::newInstance(! self::arrayContainsAtLeastOneValueIdenticalTo($variables, $reference));
	}

	private static function arrayHasSameSizeThan(array $first, array $second)
	{
		return self::newInstance(sizeof($first) == sizeof($second));
	}

	private static function variableIsNumeric($variable)
	{
		return is_numeric($variable);
	}

	private static function variableIsNotNumeric($variable)
	{
		return ! self::variableIsNumeric($variable);
	}

	private static function arrayContainsAtLeastOneValueIdenticalTo(array $variables, $reference)
	{
		return in_array($reference, $variables, true);
	}
}
