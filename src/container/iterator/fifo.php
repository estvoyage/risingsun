<?php namespace estvoyage\risingsun\container\iterator;

use estvoyage\risingsun\{ oboolean, container\iterator, container\payload, block\functor };

class fifo
	implements
		iterator
{
	private
		$controller
	;

	function __construct(iterator\controller $controller)
	{
		$this->controller = $controller;
	}

	function payloadForContainerValuesIs(array $values, payload $payload)
	{
		$this->controller
			->blockToStopContainerIteratorEngineIs(
				new functor(
					function($controller) use ($values, $payload, & $break)
					{
						$position = 0;

						foreach ($values as $value)
						{
							$payload->containerIteratorControllerForValueAtPositionIs($value, new position($position++), $controller);

							if ($break)
							{
								break;
							}
						}
					}
				),
				new functor(
					function() use (& $break)
					{
						$break = true;
					}
				)
			)
		;

		return $this;
	}
}
