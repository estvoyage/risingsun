<?php namespace estvoyage\risingsun\bench;

use estvoyage\risingsun\{ bench, block, time\duration, time\clock, time\duration\timestamp\unix\micro as timestamp };

class micro
	implements
		bench
{
	private
		$clock
	;

	function __construct(clock $clock = null)
	{
		$this->clock = $clock ?: new clock\timestamp\unix\micro;
	}

	function recipientOfDurationForBlockIs(block $block, duration\recipient $recipient)
	{
		$this->clock
			->recipientOfMicroUnixTimestampIs(
				new timestamp\recipient\functor(
					function($start) use ($block, $recipient)
					{
						$block->blockArgumentsAre();

						$this->clock
							->recipientOfMicroUnixTimestampIs(
								new timestamp\recipient\functor(
									function($stop) use ($recipient, $start)
									{
										(new timestamp\operation\binary\substraction($stop))
											->recipientOfOperationOnMicroUnixTimestampsIs(
												$stop,
												$start,
												new timestamp\recipient\functor(
													function($duration) use ($recipient)
													{
														$recipient->durationIs($duration);
													}
												)
											)
										;
									}
								)
							)
						;
					}
				)
			)
		;

		return $this;
	}
}
