<?php namespace estvoyage\risingsun\comparison\recipient;

use estvoyage\{ risingsun, risingsun\comparison };

class oboolean
	implements
		comparison\recipient
{
	private
		$template,
		$recipient
	;

	function __construct(risingsun\oboolean $template, risingsun\oboolean\recipient $recipient)
	{
		$this->template = $template;
		$this->recipient = $recipient;
	}

	function nbooleanIs(bool $nboolean)
	{
		$this->template
			->recipientOfOBooleanWithNBooleanIs(
				$nboolean,
				$this->recipient
			)
		;
	}
}
