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
		return $this->ifIsEqualToHttpUrlPath(new self(self::root()), $isEqual, $isNotEqual);
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
						$_this = self::valueOfPathIs($this, self::root());

						$this->value
							->recipientOfStringBeforeLastStringIs(
								self::root(),
								new ostring\recipient\block\functor(function($value) use ($_this) { $_this->value = $value; })
							)
						;

						$recipient->httpUrlPathIs($_this);
					}
				)
			)
		;

		return $this;
	}

	function recipientOfHttpUrlPathWithoutHeadIs(self $head, path\recipient $recipient)
	{
		$this
			->ifIsNotRoot(
				new block\functor(
					function() use ($head, $recipient)
					{
						$this->value
							->recipientOfStringWithoutPrefixIs(
								$head->value,
								new ostring\recipient\block\functor(
									function($string) use ($head, $recipient)
									{
										$recipient
											->httpUrlPathIs(
												self::valueOfPathIs(
													$this,
													ostring\notEmpty::defaultIfStringIsEmptyIs(
														$string,
														self::root()
													)
												)
											)
										;
									}
								)
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

	private static function root()
	{
		static $root;

		return ($root ?: $root = new risingsun\ostring\notEmpty('/'));
	}

	private static function valueOfPathIs(self $path, risingsun\ostring\notEmpty $value)
	{
		$path = clone $path;
		$path->value = $value;

		return $path;
	}
}
