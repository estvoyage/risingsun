<?php namespace estvoyage\risingsun\ofloat\comparison;

use estvoyage\risingsun\{ ofloat, comparison };

interface unary
{
	function recipientOfComparisonWithOFloatIs(ofloat $ofloat, comparison\recipient $recipient);
}
