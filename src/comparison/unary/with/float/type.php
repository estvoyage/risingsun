<?php namespace estvoyage\risingsun\comparison\unary\with\float;

use estvoyage\risingsun\{ comparison, oboolean\recipient, oboolean };

class type extends comparison\unary\with\true\boolean
{
	function recipientOfComparisonWithValueIs($value, recipient $recipient)
	{
		return parent::recipientOfComparisonWithValueIs(is_float($value), $recipient);
	}
}
