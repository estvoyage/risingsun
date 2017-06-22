<?php namespace estvoyage\risingsun\time\duration\seconde\recipient;

use estvoyage\risingsun\{ block, time\duration };

class functor extends block\functor
	implements
		duration\seconde\recipient
{
	function secondeIs(duration\seconde $seconde) :void
	{
		$this->blockArgumentsAre($seconde);
	}
}
