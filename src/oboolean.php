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
}
