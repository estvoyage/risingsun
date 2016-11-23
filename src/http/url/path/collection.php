<?php namespace estvoyage\risingsun\http\url\path;

use
	estvoyage\risingsun,
	estvoyage\risingsun\block,
	estvoyage\risingsun\http\url
;

class collection
{
	private
		$collection
	;

	function __construct(url\path... $path)
	{
		$this->collection = new risingsun\collection(... $path);
	}

	function recipientOfHttpUrlPathCollectionWithPathIs(url\path $path, collection\recipient $recipient)
	{
		$this
			->collection
				->recipientOfCollectionWithValueIs(
					$path,
					new class(
						new block\functor(
							function($collection) use ($recipient) {
								$_this = clone $this;
								$_this->collection = $collection;

								$recipient->httpUrlPathCollectionIs($_this);
							}
						)
					)
						implements
							risingsun\collection\recipient
					{
						private
							$block
						;

						function __construct(block $block)
						{
							$this->block = $block;
						}

						function collectionIs(risingsun\collection $collection)
						{
							$this->block->blockArgumentsAre($collection);
						}
					}
				)
		;

		return $this;
	}

	function payloadForIteratorIs(risingsun\iterator $iterator, risingsun\iterator\payload $payload)
	{
		$this->collection->payloadForIteratorIs($iterator, $payload);

		return $this;
	}
}
