<?php namespace estvoyage\risingsun\comparison;

use estvoyage\risingsun\{ comparison, oboolean };

interface unary
{
	function recipientOfComparisonWithValueIs($value, oboolean\recipient $recipient);
}
