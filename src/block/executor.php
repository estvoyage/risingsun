<?php namespace estvoyage\risingsun\block;

use
	estvoyage\risingsun
;

class executor
{
	private
		$block
	;

	function __construct(risingsun\block $block)
	{
		$this->block = $block;
	}

	function errorManagerIs(risingsun\error\manager $errorManager)
	{
		$previousErrorHandler = set_error_handler(function($errno, $errstr) use (& $error) {
				$error = new risingsun\error($errstr);
			}
		);

		$this->block->blockArgumentsAre();

		set_error_handler($previousErrorHandler);

		risingsun\oboolean::isNotNull($error)
			->ifTrue(
				new risingsun\block\functor(
					function() use ($errorManager, $error) {
						$errorManager->errorIs($error);
					}
				)
			)
		;

		return $this;
	}
}
