# PHPUnit Listener

Experimental plugin for PHPUnit that allows for prefixes other than `test` to be used without having
to annotate each test method with a `@test` annotation. This was written in response to this
[pull request](https://github.com/sebastianbergmann/phpunit/pull/2047).

## Example

```xml
<listeners>
    <listener class="Unfunco\PHPUnit\Listener\PrefixListener">
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
```

## License

Copyright © 2016 [Daniel Morris](https://github.com/unfunco)  
Licensed under the terms of [The MIT License](LICENSE.md).
