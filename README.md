# *estvoyage\risingsun* [![Build Status](https://travis-ci.org/estvoyage/risingsun.svg?branch=master)](https://travis-ci.org/estvoyage/risingsun)

## A PHP east-oriented (web) framework

However, it was designed using the east compass, so all public methods in all classes return `$this` or a new instance of the class.  
Why? Because the rigorous application of this unique rule decreases coupling and the amount of code that needs to be written, while increasing the clarity, cohesion, flexibility, reuse and testability of that code.  
In fact, using east-oriented principle force using abstraction via interface and the lack of getter force using the *tell, don't ask* principle, inversion of control, depedency injection and interfaces.  

## Unit Tests

Setup the test suite using Composer:

    $ composer install --dev

Run it using **atoum**:

    $ vendor/bin/atoum

## Contributing

See the bundled `CONTRIBUTING` file for details.

## License

*estvoyage\risingsun* is released under the FreeBSD License, see the bundled `COPYING` file for details.
