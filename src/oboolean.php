<?php namespace estvoyage\risingsun;

abstract class oboolean
{
	abstract function ifTrue(block $block);
	abstract function ifFalse(block $block);

	static function newInstance(... $values)
	{
		return in_array(false, $values, true) ? new oboolean\false : new oboolean\true;
	}

	static function keyIsInArray($key, array $array)
	{
		return self::newInstance(isset($array[(string) $key]));
	}

	static function isNotNull(... $variables)
	{
		return self::newInstance(! in_array(null, $variables, true));
	}

	static function isFalse(... $variables)
	{
		return self::newInstance(sizeof(array_keys($variables, false, true)) == sizeof($variables));
	}

	static function isTrue(... $variables)
	{
		return self::newInstance(sizeof(array_keys($variables, true, true)) == sizeof($variables));
	}

	static function isNotFalse(... $variables)
	{
		return self::newInstance(! in_array(false, $variables, true));
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

	static function isZero(... $variables)
	{
		return self::newInstance(sizeof(array_keys($variables, 0, true)) == sizeof($variables));
	}

	static function isNotZero(... $variables)
	{
		return self::newInstance(! in_array(0, $variables, true));
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
}
