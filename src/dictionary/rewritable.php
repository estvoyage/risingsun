<?php namespace estvoyage\risingsun\dictionary;

use estvoyage\risingsun\{ dictionary, block\functor };

class rewritable
	implements
		dictionary
{
	private
		$pairs
	;

	function __construct(pair... $pairs)
	{
		foreach ($pairs as $pair)
		{
			$pair
				->recipientOfDictionaryKeyIs(
					new functor(
						function($key) use ($pair)
						{
							$this->pairs[$key] = $pair;
						}
					)
				)
			;
		}
	}

	function recipientOfDictionaryWithPairIs(pair $pair, recipient $recipient)
	{
		$pair
			->recipientOfDictionaryKeyIs(
				new functor(
					function($key) use ($pair, $recipient)
					{
						$dictionary = clone $this;
						$dictionary->pairs[$key] = $pair;

						$recipient->dictionaryIs($dictionary);
					}
				)
			)
		;

		return $this;
	}
}
