<?php namespace estvoyage\risingsun\container\iterator\engine;

use estvoyage\risingsun\{ container\iterator\engine, container\iterator\payload, ointeger\generator, ointeger, block };

class fifo
	implements
		engine
{
	private
		$generator,
		$controller
	;

	function __construct(generator $generator = null, engine\controller $controller = null)
	{
		$this->generator = $generator ?: new ointeger\generator\operation\binary\addition;
		$this->controller = $controller ?: new controller\block;
	}

	function valuesForContainerIteratorPayloadIs(payload $payload, ... $values)
	{
		$this->controller
			->recipientOfContainerIteratorEngineControllerWithBlockIs(
				new block\functor(
					function() use (& $break)
					{
						$break = true;
					}
				),
				new engine\controller\recipient\functor(
					function($controller) use ($payload, $values, & $break)
					{
						foreach ($values as $value)
						{
							$this->generator
								->recipientOfOIntegerIs(
									new ointeger\recipient\functor(
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
