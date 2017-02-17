<?php namespace estvoyage\risingsun\container\iterator;

use estvoyage\risingsun\{ oboolean, container\iterator, container\payload, block\functor, ointeger\generator };

class fifo
	implements
		iterator
{
	private
		$controller,
		$generator
	;

	function __construct(iterator\controller $controller = null, generator $generator = null)
	{
		$this->controller = $controller ?: new iterator\controller\stopper;
		$this->generator = $generator ?: new generator\operation\binary\addition;
	}

	function payloadForContainerValuesIs(array $values, payload $payload)
	{
		$this->controller
			->blockToStopContainerIteratorEngineIs(
				new functor(
					function($controller) use ($values, $payload, & $break)
					{
						foreach ($values as $value)
						{
							$this->generator
								->recipientOfOIntegerIs(
									new functor(
										function($position) use ($payload, $value, $controller)
										{
											$payload->containerIteratorControllerForValueAtPositionIs($value, $position, $controller);
										}
									)
								)
							;

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
