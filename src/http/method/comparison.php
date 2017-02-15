<?php namespace estvoyage\risingsun\http\method;

use estvoyage\risingsun\{ http\method, oboolean };

interface comparison
{
	function recipientOfComparisonBetweenHttpMethodsIs(method $firstOperand, method $secondOperand, oboolean\recipient $recipient);
}
