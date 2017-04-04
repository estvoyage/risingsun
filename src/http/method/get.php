<?php namespace estvoyage\risingsun\http\method;

use estvoyage\risingsun\{ nstring, http };

class get
	implements
		http\method
{
	function recipientOfHttpMethodValueIs(nstring\recipient $recipient)
	{
		$recipient->nstringIs('GET');

		return $this;
	}
}
