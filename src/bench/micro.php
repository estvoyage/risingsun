<?php namespace estvoyage\risingsun\bench;

use estvoyage\{ risingsun, risingsun\time };

class micro
{
	private
		$clock
	;

	function __construct(time\clock $clock)
	{
		$this->clock = $clock;
	}

	function recipientOfDurationForBlockIs(block $block, time\duration\recipient $recipient)
	{
		$this->clock->recipientOfMicroUnixTimestampIs(
			new time\duration\unix\timestamp\micro\recipient\block(
				new risingsun\block\functor(
					function($start) use ($block, $recipient)
					{
						$block->benchBlockControllerIs(
							new block\controller\block(
								new risingsun\block\functor(
									function() use ($start, $recipient)
									{
										$this->clock->recipientOfMicroUnixTimestampIs(
											new time\duration\unix\timestamp\micro\recipient\block(
												new risingsun\block\functor(
													function($stop) use ($start, $recipient)
													{
														$stop->recipientOfDifferenceWithMicroUnixTimestampIs(
															$start,
															$recipient
														);
													}
												)
											)
										);
									}
								)
							)
						);
					}
				)
			)
		);

		return $this;
	}
}
