<?php

require __DIR__ . '/../vendor/autoload.php';

use
	estvoyage\risingsun\block,
	estvoyage\risingsun\iterator,
	estvoyage\risingsun\oboolean,
	estvoyage\risingsun\collection
;

(new collection(... range(0, 9)))
	->payloadForIteratorIs(
		new iterator\fifo,
		$echo = new block\functor(
			function($iterator, $value)
			{
				echo $value;
			}
		)
	)
;

echo PHP_EOL;

(new collection(... range(0, 9)))
	->payloadForIteratorIs(
		new iterator\lifo,
		$echo
	)
;

echo PHP_EOL;

($collection = new collection(... range(0, 9)))
	->payloadForIteratorIs(
		new iterator\fifo,
		new block\functor(
			function($iterator, $value) use ($echo, $collection)
			{
				$echo->blockArgumentsAre($iterator, $value);

				echo ' ';

				$collection
					->payloadForIteratorIs(
							$iterator,
							$echo
						)
				;

				echo PHP_EOL;
			}
		)
	)
;

(new collection(... range(0, 9)))
	->payloadForIteratorIs(
		new iterator\fifo,
		new block\functor(
			function($iterator, $value) use ($echo)
			{
				$echo->blockArgumentsAre($iterator, $value);

				oboolean::isEqual($value, 5)
					->ifTrue(
						new block\functor(
							function() use ($iterator) {
								$iterator->nextIteratorValuesAreUseless();
							}
						)
					)
				;
			}
		)
	)
;

echo PHP_EOL;

(new collection(... range(0, 9)))
	->recipientOfCollectionWithValueIs(
		10,
		new class($echo)
			implements
				collection\recipient
		{
			private
				$payload
			;

			function __construct(iterator\payload $payload)
			{
				$this->payload = $payload;
			}

			function collectionIs(collection $collection)
			{
				$collection
					->payloadForIteratorIs(
						new iterator\fifo,
						$this->payload
					)
				;
			}
		}
	)
;
