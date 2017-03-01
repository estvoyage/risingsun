<?php namespace estvoyage\risingsun\comparison\container\iterator;

use estvoyage\risingsun\{ comparison, container, block\functor, ointeger };

class fifo
	implements
		comparison\container\iterator
{
	private
		$generator
	;

	function __construct(ointeger\generator $generator)
	{
		$this->generator = $generator;
	}

	function comparisonsForPayloadWithControllerAre(comparison\container\payload $payload, container\iterator\controller $controller, comparison... $comparisons)
	{
		$controller
			->blockToStopContainerIteratorEngineIs(
				new functor(
					function($controller) use ($comparisons, $payload, & $break)
					{
						foreach ($comparisons as $comparison)
						{
							$this->generator
								->recipientOfOIntegerIs(
									new functor(
										function($position) use ($payload, $comparison, $controller)
										{
											$payload->iteratorControllerForComparisonAtPositionIs($comparison, $position, $controller);
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
