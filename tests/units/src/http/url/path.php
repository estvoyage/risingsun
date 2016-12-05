<?php namespace estvoyage\risingsun\tests\units\http\url;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	estvoyage\risingsun\block,
	estvoyage\risingsun\oboolean,
	estvoyage\risingsun\http\url,
	estvoyage\risingsun\http\url\path as testedClass,
	mock\estvoyage\risingsun\block as mockOfBlock,
	mock\estvoyage\risingsun\http as mockOfHttp
;

class path extends units\test
{
	/**
	 * @dataProvider invalidPathProvider
	 */
	function testWithInvalidPcrePatternValue($value)
	{
		$this
			->exception(function() use ($value) { $this->newTestedInstance(new risingsun\ostring\notEmpty($value)); })
				->isInstanceOf('domainException')
				->hasMessage('HTTP URL path must match PCRE pattern `%^/(?:[^/#?]+(?:/[^/#?]+)*)?$%\'')
		;
	}

	function testIfIsEqualToHttpUrlPath()
	{
		$this
			->given(
				$isEqualBlock = new mockOfBlock,
				$path = new risingsun\ostring\notEmpty('/' . uniqid())
			)
			->if(
				$this->newTestedInstance($path)
			)
			->then
				->object($this->testedInstance->ifIsEqualToHttpUrlPath($this->newTestedInstance($path), $isEqualBlock))
					->isEqualTo($this->newTestedInstance($path))
				->mock($isEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->given(
				$isNotEqualBlock = new mockOfBlock,
				$otherPath = new risingsun\ostring\notEmpty('/' . uniqid())
			)
			->if(
				$this->newTestedInstance($path)
			)
			->then
				->object($this->testedInstance->ifIsEqualToHttpUrlPath($this->newTestedInstance($otherPath), $isEqualBlock, $isNotEqualBlock))
					->isEqualTo($this->newTestedInstance($path))
				->mock($isEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
				->mock($isNotEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	function testIfIsRoot()
	{
		$this
			->given(
				$isEqualBlock = new mockOfBlock,
				$path = new risingsun\ostring\notEmpty('/')
			)
			->if(
				$this->newTestedInstance($path)
			)
			->then
				->object($this->testedInstance->ifIsRoot($isEqualBlock))
					->isEqualTo($this->newTestedInstance($path))
				->mock($isEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->given(
				$isNotEqualBlock = new mockOfBlock,
				$path = new risingsun\ostring\notEmpty('/' . uniqid())
			)
			->if(
				$this->newTestedInstance($path)
			)
			->then
				->object($this->testedInstance->ifIsRoot($isEqualBlock, $isNotEqualBlock))
					->isEqualTo($this->newTestedInstance($path))
				->mock($isEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
				->mock($isNotEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	function testIfIsNotRoot()
	{
		$this
			->given(
				$isNotEqualBlock = new mockOfBlock,
				$path = new risingsun\ostring\notEmpty('/' . uniqid())
			)
			->if(
				$this->newTestedInstance($path)
			)
			->then
				->object($this->testedInstance->ifIsNotRoot($isNotEqualBlock))
					->isEqualTo($this->newTestedInstance($path))
				->mock($isNotEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once

			->given(
				$isEqualBlock = new mockOfBlock,
				$path = new risingsun\ostring\notEmpty('/')
			)
			->if(
				$this->newTestedInstance($path)
			)
			->then
				->object($this->testedInstance->ifIsNotRoot($isNotEqualBlock, $isEqualBlock))
					->isEqualTo($this->newTestedInstance($path))
				->mock($isNotEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
				->mock($isEqualBlock)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}

	function testRecipientOfHttpUrlPathCollectionWithInnerPathsIs()
	{
		$this
			->given(
				$root = new risingsun\ostring\notEmpty('/'),
				$recipient = new mockOfHttp\url\path\collection\recipient,

				$collectionWithRoot = new mockOfHttp\url\path\collection,

				$collection = new mockOfHttp\url\path\collection,
				$this->calling($collection)->recipientOfHttpUrlPathCollectionWithPathIs = function($aPath, $aRecipient) use ($root, $collectionWithRoot) {
					oboolean::isEqual($aPath, $this->newTestedInstance($root))
						->ifTrue(
							new block\functor(
								function() use ($collectionWithRoot, $aRecipient) {
									$aRecipient->httpUrlPathCollectionIs($collectionWithRoot);
								}
							)
						)
					;
				}
			)
			->if(
				$this->newTestedInstance($root)
			)
			->then
				->object($this->testedInstance->recipientOfHttpUrlPathCollectionWithInnerPathsIs($collection, $recipient))
					->isEqualTo($this->newTestedInstance($root))
				->mock($recipient)
					->receive('httpUrlPathCollectionIs')
						->withIdenticalArguments($collectionWithRoot)
							->once

			->given(
				$foo = new risingsun\ostring\notEmpty('/foo'),

				$this->calling($collection)->recipientOfHttpUrlPathCollectionWithPathIs = function($aPath, $aRecipient) use ($foo, $collectionWithRoot) {
					oboolean::isEqual($aPath, $this->newTestedInstance($foo))
						->ifTrue(
							new block\functor(
								function() use ($collectionWithRoot, $aRecipient) {
									$aRecipient->httpUrlPathcollectionIs($collectionWithRoot);
								}
							)
						)
					;
				},

				$collectionWithRootAndFoo = new mockOfHttp\url\path\collection,
				$this->calling($collectionWithRoot)->recipientOfHttpUrlPathCollectionWithPathIs = function($aPath, $aRecipient) use ($foo, $collectionWithRootAndFoo) {
					oboolean::isEqual($aPath, $this->newTestedInstance(new risingsun\ostring\notEmpty('/')))
						->ifTrue(
							new block\functor(
								function() use ($collectionWithRootAndFoo, $aRecipient) {
									$aRecipient->httpUrlPathCollectionIs($collectionWithRootAndFoo);
								}
							)
						)
					;
				}
			)
			->if(
				$this->newTestedInstance($foo)
			)
			->then
				->object($this->testedInstance->recipientOfHttpUrlPathCollectionWithInnerPathsIs($collection, $recipient))
					->isEqualTo($this->newTestedInstance($foo))
				->mock($recipient)
					->receive('httpUrlPathCollectionIs')
						->withIdenticalArguments($collectionWithRootAndFoo)
							->once
		;
	}

	function testRecipientOfParentPathIs()
	{
		$this
			->given(
				$recipient = new mockOfHttp\url\path\recipient,
				$path = new risingsun\ostring\notEmpty('/')
			)
			->if(
				$this->newTestedInstance($path)
			)
			->then
				->object($this->testedInstance->recipientOfParentPathIs($recipient))
					->isEqualTo($this->newTestedInstance($path))
				->mock($recipient)
					->receive('httpUrlPathIs')
						->never

			->given(
				$path = new risingsun\ostring\notEmpty('/foo')
			)
			->if(
				$this->newTestedInstance($path)
			)
			->then
				->object($this->testedInstance->recipientOfParentPathIs($recipient))
					->isEqualTo($this->newTestedInstance($path))
				->mock($recipient)
					->receive('httpUrlPathIs')
						->withArguments($this->newTestedInstance(new risingsun\ostring\notEmpty('/')))
							->once
		;
	}

	function testToString()
	{
		$this
			->given(
				$path = new risingsun\ostring\notEmpty('/' . uniqid())
			)
			->if(
				$this->newTestedInstance($path)
			)
			->then
				->object(testedClass::toString($this->testedInstance))->isEqualTo($path)
		;
	}

	function testRecipientOfHttpUrlPathWithoutHeadIs()
	{
		$this
			->given(
				$recipient = new mockOfHttp\url\path\recipient,
				$head = $this->newTestedInstance(new risingsun\ostring\notEmpty('/'))
			)
			->if(
				$this->newTestedInstance(new risingsun\ostring\notEmpty('/'))
			)
			->then
				->object($this->testedInstance->recipientOfHttpUrlPathWithoutHeadIs($head, $recipient))
					->isEqualTo($this->newTestedInstance(new risingsun\ostring\notEmpty('/')))
				->mock($recipient)
					->receive('httpUrlPathIs')
						->withArguments($this->newTestedInstance(new risingsun\ostring\notEmpty('/')))
							->once

			->given(
				$head = $this->newTestedInstance(new risingsun\ostring\notEmpty('/foo'))
			)
			->if(
				$this->newTestedInstance(new risingsun\ostring\notEmpty('/foo'))
			)
			->then
				->object($this->testedInstance->recipientOfHttpUrlPathWithoutHeadIs($head, $recipient))
					->isEqualTo($this->newTestedInstance(new risingsun\ostring\notEmpty('/foo')))
				->mock($recipient)
					->receive('httpUrlPathIs')
						->withArguments($this->newTestedInstance(new risingsun\ostring\notEmpty('/')))
							->twice

			->given(
				$head = $this->newTestedInstance(new risingsun\ostring\notEmpty('/foo'))
			)
			->if(
				$this->newTestedInstance(new risingsun\ostring\notEmpty('/foo/bar'))
			)
			->then
				->object($this->testedInstance->recipientOfHttpUrlPathWithoutHeadIs($head, $recipient))
					->isEqualTo($this->newTestedInstance(new risingsun\ostring\notEmpty('/foo/bar')))
				->mock($recipient)
					->receive('httpUrlPathIs')
						->withArguments($this->newTestedInstance(new risingsun\ostring\notEmpty('/bar')))
							->once
		;
	}

	protected function invalidPathProvider()
	{
		return [
			uniqid(),
			'/#',
			'/foo#',
			'/foo?',
			'/foo/',
			'/foo/bar/'
		];
	}
}
