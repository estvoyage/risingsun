<?php namespace estvoyage\risingsun\comparison\recipient\functor;

use estvoyage\risingsun\{ comparison, block };

class ok extends block\functor
	implements
		comparison\recipient
{
	function nbooleanIs(bool $bool)
	{
		! $bool ?: $this->blockArgumentsAre();
	}
}
