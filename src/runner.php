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

	function blockIs(block $block)
	{
		$block->blockArgumentsAre($this->output);

		return $this;
	}
}
