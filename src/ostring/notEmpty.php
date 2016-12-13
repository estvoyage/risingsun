<?php namespace estvoyage\risingsun\ostring;

use
	estvoyage\risingsun,
	estvoyage\risingsun\block
;

class notEmpty extends risingsun\ostring
{
	function __construct($value)
	{
		$domainException = null;

		try
		{
			parent::__construct($value);
		}
		catch (\domainException $domainException) {}

		if ($domainException || $value == '')
		{
			throw new \domainException('Value should be a not empty string');
		}
	}

	static function defaultIfStringIsEmptyIs(risingsun\ostring $string, self $default)
	{
		$string
			->ifIsEmptyString(
				new block\functor(
					function() use (& $string, $default)
					{
						$string = $default;
					}
				),
				new block\functor(
					function() use (& $string, $default)
					{
						$string = risingsun\ostring::copy($string, $default);
					}
				)
			)
		;

		return $string;
	}
}
