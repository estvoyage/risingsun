<?php namespace estvoyage\risingsun\http\method;

use estvoyage\risingsun\{ nstring, http\method, oboolean };

class get
	implements
		method
{
	function recipientOfHttpMethodValueIs(nstring\recipient $recipient)
	{
		$recipient->nstringIs('GET');

		return $this;
	}

	function recipientOfComparisonWithHttpMethodIs(comparison $comparison, method $method, oboolean\recipient $recipient)
	{
		$comparison->recipientOfComparisonBetweenHttpMethodsIs($this, $method, $recipient);

		return $this;
	}
}
