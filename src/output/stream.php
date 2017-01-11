<?php namespace estvoyage\risingsun\output;

use estvoyage\{ risingsun, risingsun\block };

class stream extends risingsun\ostring
{
	function recipientOfOutputStreamWithIteratorContentsAsSuffixIs(stream\iterator $iterator, stream\recipient $recipient)
	{
		(
			new class($this, $iterator, $recipient)
			{
				private
					$string
				;

				function __construct(stream $stream, stream\iterator $iterator)
				{
					$this->string = $stream;

					$iterator
						->recipientOfOutputStreamIs(
							new stream\recipient\block(
								new block\functor(
									function($stream)
									{
										$this->string
											->recipientOfStringWithSuffixIs(
												$stream,
												new risingsun\ostring\recipient\block(
													new block\functor(
														function($string)
														{
															$this->string = $string;
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
				}

				function recipientOfOutputStreamIs(stream\recipient $recipient)
				{
					$recipient->outputStreamIs(new stream($this->string));
				}
			}
		)
			->recipientOfOutputStreamIs($recipient)
		;

		return $this;
	}
}
