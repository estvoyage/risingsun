<?php namespace estvoyage\risingsun\time;

interface duration
{
	function recipientOfNumberOfSecondIs(second\recipient $recipient);
	function recipientOfNumberOfMicroSecondIs(second\micro\recipient $recipient);
}
