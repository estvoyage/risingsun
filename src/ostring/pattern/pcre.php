<?php namespace estvoyage\risingsun\ostring\pattern;

use
	estvoyage\risingsun,
	estvoyage\risingsun\hash,
	estvoyage\risingsun\block,
	estvoyage\risingsun\iterator,
	estvoyage\risingsun\oboolean
;

class pcre extends risingsun\ostring\notEmpty
	implements
		risingsun\hash\recipient,
		risingsun\ostring\pattern
{
	private
		$names,
		$hash
	;

	function __construct($value, hash\key... $names)
	{
		$this->matches = [];

		oboolean::throwException(new block\functor(function() use ($value) { parent::__construct($value); }))
			->ifTrue(
				new block\functor(
					function() {
						throw new \domainException('PCRE pattern must be a not empty string');
					}
				)
			)
			->ifFalse(
				new block\functor(
					function() use ($value, $names) {
						(new block\executor(new block\functor(function() { preg_match($this, ''); })))
						 	->errorManagerIs(
						 		new block\functor(
						 			function($errorMessage) {
										throw new \domainException('Pattern \'' . $this . '\' is not a valid PCRE regular expression: ' . $errorMessage);
						 			}
						 		)
						 	)
						;

						$this->names = $names;
					}
				)
			)
		;
	}

	function recipientOfHashWithPatternDataFromStringIs(hash $hash, risingsun\ostring $string, data\recipient $recipient)
	{
		$pattern = clone $this;
		$pattern->hash = $hash;

		$matches = [];

		$pattern->match($string, $matches)
			->ifTrue(
				new block\functor(
					function() use ($pattern, $matches, $recipient, $hash) {
						(new iterator(... array_slice($matches, 1, sizeof(sizeof($pattern->names) <= sizeof($matches) ? $pattern->names : $matches))))
							->iteratorPayloadIs(
								new block\functor(
									function($iterator, $value) use ($pattern, & $key) {
										static $key = 0;

										$pattern->hash->recipientOfHashWithValueIs(new hash\value\withKey(new risingsun\ostring($value), $pattern->names[$key++]), $pattern);
									}
								)
							)
						;

						$recipient->hashContainsPatternDataFromString($pattern->hash, new risingsun\ostring($matches[0]));
					}
				)
			)
		;

		return $this;
	}

	function ifIsPatternOfString(risingsun\ostring $string, block $block)
	{
		$this->match($string)->ifTrue($block);

		return $this;
	}

	function ifIsNotPatternOfString(risingsun\ostring $string, block $block)
	{
		oboolean::complement($this->match($string))->ifTrue($block);

		return $this;
	}

	function hashIs(hash $hash)
	{
		oboolean::isNotNull($this->hash)
			->ifTrue(
				new block\functor(
					function() use ($hash) {
						$this->hash = $hash;
					}
				)
			)
		;

		return $this;
	}

	private function match($string, array & $matches = [])
	{
		return oboolean::isNotZero(preg_match($this, $string, $matches));
	}
}
