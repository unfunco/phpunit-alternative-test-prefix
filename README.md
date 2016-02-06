# PHPUnit alternative test prefix listener

[![Build Status](https://travis-ci.org/unfunco/phpunit-alternative-test-prefix.svg?branch=master)](https://travis-ci.org/unfunco/phpunit-alternative-test-prefix)

Listener for PHPUnit that allows for alternative test method prefixes to be specified within the PHPUnit configuration
file, without also having to use the `@test` annotation.

## Installation and usage

Add `unfunco/phpunit-alternative-test-prefix` to your `require-dev` dependencies and run `composer install`, once
installed you can configure the alternative test prefix listener within your test configuration.

### Configuration

```xml
<phpunit bootstrap="vendor/autoload.php">
  ...
  <listeners>
    <listener class="Unfunco\PHPUnit\Listener\AlternativeTestPrefixListener">
      <arguments>
        <array>
          <element key="itCan">
            <string>itCan</string>
          </element>
          <element key="itDoes">
            <string>itDoes</string>
          </element>
        </array>
      </arguments>
    </listener>
  </listeners>
</phpunit>
```

## License

Copyright © 2016 [Daniel Morris](https://github.com/unfunco).  
Licensed under the terms of [The MIT License](LICENSE.md).
