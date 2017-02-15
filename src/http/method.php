<?php namespace estvoyage\risingsun\http;

use estvoyage\risingsun\{ nstring, http\method, oboolean };

interface method
{
	function recipientOfHttpMethodValueIs(nstring\recipient $recipient);
	function recipientOfComparisonWithHttpMethodIs(method\comparison $comparison, method $method, oboolean\recipient $recipient);
}
