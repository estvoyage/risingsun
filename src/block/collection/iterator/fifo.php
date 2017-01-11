<?php namespace estvoyage\risingsun\block\collection\iterator;

use
	estvoyage\risingsun,
	estvoyage\risingsun\block
;

class fifo
	implements
		block\collection\iterator
{
	private
		$iterator
	;

	function __construct()
	{
		$this->iterator = new risingsun\iterator\fifo;
	}

	function blocksForPayloadAre(block\collection\payload $payload, block... $blocks)
	{
		$this->iterator
			->iteratorPayloadForValuesIs(
				$blocks,
				new block\functor(function($iterator, $block) use ($payload) {
					$payload->currentBlockOfIteratorIs($iterator, $block);
				}
			)
		);

		return $this;
	}
}
