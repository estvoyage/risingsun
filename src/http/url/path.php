<?php namespace estvoyage\risingsun\http\url;

use
	estvoyage\risingsun,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean
;

class path
{
	private
		$value
	;

	private static
		$pattern
	;

	function __construct(risingsun\ostring\notEmpty $path)
	{
		self::$pattern = self::$pattern ?: new risingsun\ostring\pattern\pcre('%^/(?:[^/#?]+(?:/[^/#?]+)*)?$%');

		self::$pattern
			->ifIsPatternOfString(
				$path,
				new block\functor(
					function() use ($path) {
						$this->value = $path;
					}
				),
				new block\exception\domain(
					new risingsun\ostring\notEmpty(
						'HTTP URL path must match PCRE pattern `' . self::$pattern . '\''
					)
				)
			)
		;
	}

	function ifIsEqualToHttpUrlPath(self $path, risingsun\block $isEqual, risingsun\block $isNotEqual = null)
	{
		$this
			->value
				->ifIsEqualToString(
					$path->value,
					$isEqual,
					$isNotEqual
				)
		;

		return $this;
	}

	static function toString(self $path)
	{
		return $path->value;
	}
}
