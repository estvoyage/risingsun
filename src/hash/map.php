<?php namespace estvoyage\risingsun\hash;

use
	estvoyage\risingsun,
	estvoyage\risingsun\block,
	estvoyage\risingsun\iterator,
	estvoyage\risingsun\oboolean
;

class map
	implements
		risingsun\hash,
		value\contents\recipient
{
	private
		$values,
		$newValues
	;

	function __construct(value... $values)
	{
		$this->values = [];

		self::hashIsRecipientOfValues($this, ... $values);
	}

	function recipientOfHashValueAtKeyIs(key $key, value\recipient $recipient)
	{
		oboolean::keyIsInArray($key = (string) $key, $this->values)
			->ifTrue(new block\functor(function() use ($key, $recipient) {
						$recipient->hashHasValue($this->values[$key]);
					}
				)
			)
		;

		return $this;
	}

	function hashValueContentsIs(key $key, $value)
	{
		$this->newValues
			->ifTrue(new block\functor(function() use ($key, $value) {
						$this->values[(string) $key] = $value;
					}
				)
			)
		;

		return $this;
	}

	function recipientOfHashWithValueIs(value $value, recipient $recipient)
	{
		$recipient->hashIs(self::hashIsRecipientOfValues(clone $this, $value));

		return $this;
	}

	private static function hashIsRecipientOfValues(self $hash, value... $values)
	{
		$hash->newValues = new oboolean\right;

		(new iterator(... $values))
			->iteratorPayloadIs(new block\functor(function($iterator, $value) use ($hash) {
						$value->recipientOfHashValueContentsIs($hash);
					}
				)
			)
		;

		$hash->newValues = new oboolean\wrong;

		return $hash;
	}
}
