<?php namespace estvoyage\risingsun\http\url;

use
	estvoyage\risingsun,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean
;

class path extends risingsun\ostring
{
	function __construct(risingsun\ostring\notEmpty $path = null)
	{
		self::patternMatch($path = $path ?: new risingsun\ostring\notEmpty('/'))
			->ifTrue(
				new block\functor(
					function() use ($path) {
						parent::__construct($path);
					}
				)
			)
			->ifFalse(
				new block\functor(
					function() {
						throw new \domainException('HTTP URL path must match PCRE pattern \`^/(?:[^/#?](?:/[^/#?])*)?$\'');
					}
				)
			)
		;
	}

	private static function patternMatch(risingsun\ostring\notEmpty $path)
	{
		$match = false;

		(new risingsun\ostring\pattern\pcre('%^/$%'))
			->ifIsPatternOfString(
				$path,
				new block\functor(
					function() use (& $match) {
						$match = ! $match;
					}
				)
			)
		;

		return oboolean::isTrue($match);
	}
}
