<?php namespace estvoyage\risingsun\tests\functionals;

use estvoyage\risingsun\
	{
		container\iterator\fifo,
		container\iterator\controller\stopper,
		block\functor,
		ointeger,
		datum,
		ostring,
		output,
		datum\container\payload,
		container\iterator\position,
		container\iterator\lifo,
		container\iterator\controller\blackhole
	}
;

require __DIR__ . '/../../../vendor/autoload.php';

(
	new datum\container\collection(
		new ointeger\any,
		new ointeger\any(1),
		new ointeger\any(2),
		new ointeger\any(3),
		new ointeger\any(4),
		new ointeger\any(5),
		new ointeger\any(6),
		new ostring\any(uniqid())
	)
)
	->payloadForDatumContainerIteratorIs(
		new fifo,
		new payload\output\line(
			new output\stdout,
			new datum\operation\binary\pair
		)
	)
	->payloadForDatumContainerIteratorIs(
		new fifo(new stopper, new ointeger\generator\operation\binary\addition(new ointeger\any(42), new ointeger\any(42))),
		new payload\output\line(
			new output\stdout,
			new datum\operation\binary\pair
		)
	)
	->payloadForDatumContainerIteratorIs(
		new lifo,
		new datum\container\payload\collection(
			new payload\output\line(
				new output\stdout,
				new datum\operation\binary\pair(
					new ostring\any('[ \''),
					new ostring\any('\' => \''),
					new ostring\any('\' ]')
				)
			),
			new position\comparator(new ointeger\comparison\unary\equal(new ointeger\any(3)))
		)
	)
	->payloadForDatumContainerIteratorIs(
		new lifo(new blackhole),
		new datum\container\payload\collection(
			new payload\output\line(
				new output\stdout,
				new datum\operation\binary\pair
			)
		)
	)
;
