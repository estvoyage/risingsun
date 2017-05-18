<?php namespace estvoyage\risingsun\comparison\recipient;

use estvoyage\risingsun\{ block, comparison };

class error extends block\error
	implements
		comparison\recipient
{
	function nbooleanIs(bool $bool)
	{
		! $bool ?: $this->blockArgumentsAre();

		return $this;
	}
}
