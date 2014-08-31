# distill-cli: Command line tool to extract files from compressed archives

[![Build Status](https://secure.travis-ci.org/raulfraile/distill-cli.png)](http://travis-ci.org/raulfraile/distill-cli)
[![Latest Stable Version](https://poser.pugx.org/raulfraile/distill-cli/v/stable.png)](https://packagist.org/packages/raulfraile/distill-cli)
[![Total Downloads](https://poser.pugx.org/raulfraile/distill-cli/downloads.png)](https://packagist.org/packages/raulfraile/distill-cli)
[![Latest Unstable Version](https://poser.pugx.org/raulfraile/distill-cli/v/unstable.png)](https://packagist.org/packages/raulfraile/distill-cli)

`distill-cli` is a command line tool to extract files from compressed archives. It relies on the [raulfraile/distill](https://github.com/raulfraile/distill)
library to extract files from `bz2`, `gz`, `phar`, `rar`, `tar`, `tar.bz2`, `tar.gz`, `tar.xz`, `7z`, `xz`
and `zip` archives.

## Installation

### Locally

Download the [distill-cli.phar](https://github.com/raulfraile/distill-cli/raw/master/bin/distill-cli.phar) file and store it somewhere on your computer.

### Globally (manual)

You can run these commands to easily access distill-cli from anywhere on your system:

```
$ sudo wget https://github.com/raulfraile/distill-cli/raw/master/bin/distill-cli.phar -O /usr/local/bin/distill-cli
```

or with curl:

```
$ sudo curl https://github.com/raulfraile/distill-cli/raw/master/bin/distill-cli.phar -o /usr/local/bin/distill-cli
```

then:

```
$ sudo chmod a+x /usr/local/bin/distill-cli
```

Then, just run `distill-cli`.

### Globally (Composer)

To install `distill-cli`, install Composer and issue the following command:

```
$ ./composer.phar global require raulfraile/distill-cli @stable
```

Then, make sure you have ~/.composer/vendor/bin in your PATH, and you're good to go:

export PATH="$PATH:$HOME/.composer/vendor/bin"

## Credits

* Raul Fraile ([@raulfraile](https://twitter.com/raulfraile))
* [All contributors](https://github.com/raulfraile/distill-cli/contributors)

## License

`distill-cli` is released under the MIT License. See the bundled LICENSE file for details.
