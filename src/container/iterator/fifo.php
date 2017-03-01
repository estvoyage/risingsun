<?php namespace estvoyage\risingsun\container\iterator;

use estvoyage\risingsun\{ container\iterator, block\functor, ointeger\generator, datum };

class fifo
	implements
		datum\container\iterator
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

	function dataForPayloadAre(datum\container\payload $payload, datum... $data)
	{
		$this->controller
			->blockToStopContainerIteratorEngineIs(
				new functor(
					function($controller) use ($data, $payload, & $break)
					{
						foreach ($data as $datum)
						{
							$this->generator
								->recipientOfOIntegerIs(
									new functor(
										function($position) use ($payload, $datum, $controller)
										{
											$payload->containerIteratorControllerForDatumAtPositionIs($datum, $position, $controller);
										}
									)
								)
							;

							if ($break)
							{
								break;
							}
						}

						if (! $break)
						{
							$controller->endOfIterations();
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
