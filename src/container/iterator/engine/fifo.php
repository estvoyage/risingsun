<?php namespace estvoyage\risingsun\container\iterator\engine;

use estvoyage\risingsun\{ container\iterator\engine, container\iterator\payload, ointeger\generator, block\functor, ointeger, oboolean };

class fifo
	implements
		engine
{
	private
		$generator,
		$controller
	;

	function __construct(engine\controller $controller = null, generator $generator = null)
	{
		$this->controller = $controller ?: new controller\block;
		$this->generator = $generator ?: new ointeger\generator\operation\binary\addition;
	}

	function valuesForContainerIteratorPayloadIs(payload $payload, ... $values)
	{
		$this->controller
			->recipientOfContainerIteratorEngineControllerWithBlockIs(
				new functor(
					function() use (& $break)
					{
						$break = true;
					}
				),
				new functor(
					function($controller) use ($payload, $values, & $break)
					{
						foreach ($values as $value)
						{
							$this->generator
								->recipientOfOIntegerIs(
									new functor(
										function($position) use ($payload, $value, $controller)
										{
											$payload->containerIteratorEngineControllerOfValueAtPositionIs($value, $position, $controller);
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
				)
			)
		;

		return $this;
	}
}
