<?php namespace estvoyage\risingsun\output\stream\formater\duration;

use estvoyage\risingsun\{ block, output, time };

class secondAndMicroSecond
	implements
		output\formater\duration
{
	private
		$defaultSecond,
		$defaultMicro
	;

	function __construct(output\stream $defaultSecond, output\stream $defaultMicro)
	{
		$this->defaultSecond = $defaultSecond;
		$this->defaultMicro = $defaultMicro;
	}

	function outputForDurationIs(time\duration $duration, output $output)
	{
		(
			new class($this->defaultSecond, $this->defaultMicro)
			{
				private
					$second,
					$micro
				;

				function __construct(output\stream $second, output\stream $micro)
				{
					$this->second = $second;
					$this->micro = $micro;
				}

				function outputForDurationIs(time\duration $duration, output $output)
				{
					$duration
						->recipientOfNumberOfSecondIs(
							new time\second\recipient\block(
								new block\functor(
									function($aSecond) use ($duration)
									{
										$this->second = new output\stream($aSecond);

										$duration
											->recipientOfNumberOfMicroSecondIs(
												new time\second\micro\recipient\block(
													new block\functor(
														function($aMicro)
														{
															$this->micro = new output\stream($aMicro);
														}
													)
												)
											)
										;
									}
								)
							)
						)
					;

					$output->outputStreamIs(new output\stream($this->second . '.' . $this->micro));
				}
			}
		)
			->outputForDurationIs($duration, $output)
		;

		return $this;
	}
}
