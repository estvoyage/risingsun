<?php namespace estvoyage\risingsun\comparison\recipient;

use estvoyage\risingsun\{ comparison, block };

class switcher
	implements
		comparison\recipient
{
	private
		$ok,
		$ko
	;

	function __construct(block $ok, block $ko = null)
	{
		$this->ok = $ok;
		$this->ko = $ko ?: new block\blackhole;
	}

	function nbooleanIs(bool $bool)
	{
		$this->{ $bool ? 'ok' : 'ko'}->blockArgumentsAre();
	}
}
