<?php namespace estvoyage\risingsun;

class runner
{
	private
		$output
	;

	function __construct(output $output)
	{
		$this->output = $output;
	}

	function blockCollectionIs(block\collection $collection)
	{
		$collection
			->payloadForIteratorIs(
				new iterator\fifo,
				new block\functor(
					function($iterator, $block) {
						$block->blockArgumentsAre($this->output);
					}
				)
			)
		;

		return $this;
	}
}
