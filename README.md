# PHPUnit Test Extension

Provides a listener which allows PHPUnit to load extensions without using inheritance. Extensions provide common convenience methods to your tests. 

## Installation

## Configuration

To configure the listener simply register it in your phpunit.xml.dist file

```xml
<listeners>
    	<listener class="\GiftCards\TestExtension\Listener\AddTestCaseExtensionsListener">
        	<arguments>
         		<array>
            		<element>
              			<string>\GiftCards\Extensions\EntityExtension</string>
              			<string>\GiftCards\Extensions\OmniOrmExtension</string>
            		</element>
          		</array>
        	</arguments>
    	</listener>
 	</listeners>
```

## Usage

From your test case you can use any of the public methods that are available from within your extension.