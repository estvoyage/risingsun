<?php namespace estvoyage\risingsun\http\url;

use
	estvoyage\risingsun,
	estvoyage\risingsun\block,
	estvoyage\risingsun\ostring,
	estvoyage\risingsun\oboolean
;

class path
{
	private
		$value
	;

	function __construct(risingsun\ostring\notEmpty $path)
	{
		static $pattern;

		($pattern ?: $pattern = new risingsun\ostring\pattern\pcre('%^/(?:[^/#?]+(?:/[^/#?]+)*)?$%'))
			->ifIsPatternOfString(
				$path,
				new block\functor(
					function() use ($path)
					{
						$this->value = $path;
					}
				),
				new block\exception\domain(
					new risingsun\ostring\notEmpty(
						'HTTP URL path must match PCRE pattern `' . $pattern . '\''
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

	function ifIsRoot(risingsun\block $isEqual, risingsun\block $isNotEqual = null)
	{
		return $this->ifIsEqualToHttpUrlPath(new self(self::getRootValue()), $isEqual, $isNotEqual);
	}

	function ifIsNotRoot(risingsun\block $isNotEqual, risingsun\block $isEqual = null)
	{
		return $this->ifIsRoot($isEqual ?: new risingsun\block\blackhole, $isNotEqual);
	}

	function recipientOfHttpUrlPathCollectionWithInnerPathsIs(path\collection $collection, path\collection\recipient $recipient)
	{
		(
			new class($collection, $this)
				implements
					path\recipient,
					path\collection\recipient
			{
				private
					$collection
				;

				function __construct(path\collection $collection, path $path)
				{
					$this->collection = $collection;

					while ($path)
					{
						$this->collection->recipientOfHttpUrlPathCollectionWithPathIs($path, $this);

						$this->path = null;

						$path->recipientOfParentPathIs($this);

						$path = $this->path;
					}
				}

				function httpUrlPathIs(path $path)
				{
					$this->path = $path;
				}

				function httpUrlPathCollectionIs(path\collection $collection)
				{
					$this->collection = $collection;
				}

				function recipientOfHttpUrlPathCollectionIs(path\collection\recipient $recipient)
				{
					$recipient->httpUrlPathCollectionIs($this->collection);
				}
			}
		)
			->recipientOfHttpUrlPathCollectionIs($recipient)
		;

		return $this;
	}

	function recipientOfParentPathIs(path\recipient $recipient)
	{
		$this
			->ifIsNotRoot(
				new block\functor(
					function() use ($recipient)
					{
						$recipient
							->httpUrlPathIs(
								self::cloneWithValue(
									$this,
									(
										new class(self::getRootValue(), $this->value)
											implements
												risingsun\ostring\recipient
										{
											function __construct(risingsun\ostring\notEmpty $defaultValue, risingsun\ostring\notEmpty $value)
											{
												$this->value = $defaultValue;

												$value
													->recipientOfStringBeforeLastStringIs(
														$defaultValue,
														$this
													)
												;
											}

											function ostringIs(risingsun\ostring $string)
											{
												$this->value = $string;
											}
										}
									)->value
								)
							)
						;
					}
				)
			)
		;

		return $this;
	}

	function recipientOfHttpUrlPathWithoutHeadIs(self $head, path\recipient $recipient)
	{
		$this
			->ifIsRoot(
				new block\functor(
					function() use ($recipient)
					{
						$recipient->httpUrlPathIs($this);
					}
				),
				new block\functor(
					function() use ($head, $recipient)
					{
						$this->value
							->recipientOfStringWithoutPrefixIs(
								$head->value,
								new class(
									new block\functor(
										function($string) use ($recipient)
										{
											$string
												->ifIsEmptyString(
													new block\functor(
														function() use ($recipient)
														{
															$recipient->httpUrlPathIs(self::cloneWithValue($this, self::getRootValue()));
														}
													),
													new block\functor(
														function() use ($recipient, $string)
														{
															$recipient->httpUrlPathIs(self::cloneWithValue($this, $string));
														}
													)
												)
											;
										}
									)
								)
									implements
										ostring\recipient
								{
									private
										$block
									;

									function __construct(block $block)
									{
										$this->block = $block;
									}

									function ostringIs(ostring $string)
									{
										$this->block->blockArgumentsAre($string);
									}
								}
							)
						;
					}
				)
			)
		;

		return $this;
	}

	static function toString(self $path)
	{
		return $path->value;
	}

	private static function getRootValue()
	{
		static $root;

		return ($root ?: $root = new risingsun\ostring\notEmpty('/'));
	}

	private static function cloneWithValue(self $path, risingsun\ostring\notEmpty $value)
	{
		$path = clone $path;
		$path->value = $value;

		return $path;
	}
}
