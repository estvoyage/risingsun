<?php namespace estvoyage\risingsun\container\iterator;

use estvoyage\risingsun\{ container\iterator, block\functor, ointeger\generator, datum, comparison, block };

class fifo
	implements
		datum\container\iterator,
		comparison\binary\container\iterator
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
		return $this->valuesOfControllerForBlockIs(
			$this->controller,
			new functor(
				function($datum, $position, $controller) use ($payload)
				{
					$payload->containerIteratorControllerForDatumAtPositionIs($datum, $position, $controller);
				}
			),
			$data
		);

	}

	function binaryComparisonsForPayloadWithControllerAre(comparison\binary\container\payload $payload, iterator\controller $controller, comparison\binary... $comparisons)
	{
		return $this->valuesOfControllerForBlockIs(
			$controller,
			new functor(
				function($comparison, $position, $controller) use ($payload)
				{
					$payload->iteratorControllerForBinaryComparisonAtPositionIs($comparison, $position, $controller);
				}
			),
			$comparisons
		);
	}

	private function valuesOfControllerForBlockIs(iterator\controller $controller, block $block, array $values)
	{
		$controller
			->blockToStopContainerIteratorEngineIs(
				new functor(
					function($controller) use ($values, $block, & $break)
					{
						foreach ($values as $value)
						{
							$this->generator
								->recipientOfOIntegerIs(
									new functor(
										function($position) use ($block, $value, $controller)
										{
											$block->blockArgumentsAre($value, $position, $controller);
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
