<?php namespace estvoyage\risingsun\hash;

use
	estvoyage\risingsun,
	estvoyage\risingsun\block,
	estvoyage\risingsun\iterator,
	estvoyage\risingsun\oboolean
;

class map
	implements
		risingsun\hash
{
	private
		$values
	;

	function __construct(value... $values)
	{
		$this->values = [];

		(new class(new block\functor(function($values) { $this->values = $values; }))
			implements
				value\contents\recipient
		{
			private
				$values,
				$block
			;

			function __construct(block $block)
			{
				$this->values = [];
				$this->block = $block;
			}

			function hashValueContentsHasKey($value, key $key)
			{
				$this->values[(string) $key] = $value;
			}

			function valuesAre(value... $values)
			{
				(new iterator(... $values))
					->iteratorPayloadIs(new block\functor(function($iterator, $value) {
								$value->recipientOfHashValueContentsIs($this);
							}
						)
					)
				;

				$this->block->blockArgumentsAre($this->values);
			}
		})
			->valuesAre(... $values)
		;
	}

	function recipientOfHashValueAtKeyIs(key $key, value\recipient $recipient)
	{
		oboolean::keyIsInArray($key = (string) $key, $this->values)
			->ifTrue(new block\functor(function() use ($key, $recipient) {
						$recipient->hashKeyHasValue($this->values[$key]);
					}
				)
			)
		;

		return $this;
	}

	function recipientOfHashWithValueIs(value $value, recipient $recipient)
	{
		(new class(new block\functor(function($value, $key) use ($recipient) { $_this = clone $this; $_this->values[(string) $key] = $value; $recipient->hashIs($_this); }))
			implements
				value\contents\recipient
		{
			private
				$block

			;
			function __construct(block $block)
			{
				$this->block = $block;
			}

			function hashValueContentsHasKey($value, key $key)
			{
				$this->block->blockArgumentsAre($value, $key);
			}

			function valueIs(value $value)
			{
				$value->recipientOfHashValueContentsIs($this);
			}
		})
			->valueIs($value)
		;

		return $this;
	}
}
