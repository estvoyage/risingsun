<?php namespace estvoyage\risingsun;

interface oboolean
{
	function recipientOfComplementIs(oboolean\recipient $recipient);
	function blockForTrueIs(block $block);
}
