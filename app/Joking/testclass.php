<?php 

use phpseclib\Net\SSH2;

class TestClass{
    public static function sayHelloName($name){
        echo("hello ".$name);
    }

    public static function doSSH(){
        $ssh = new SSH2('192.168.56.101');
        if (!$ssh->login('csgo-mg', 'csgo-mg')) {
            exit('Login Failed');
        }
        $result = $ssh->exec('ls -la');
        //echo(TestClass::getSSHResultWithLineBreaks($result));
        return $result;
    }

    public static function getSSHResultWithLineBreaks(String $sshResult){
        $withBreaks = str_replace("\n", "<br>", $sshResult);
        return str_replace("\t", "<tab indent=1>",$withBreaks);

    }
}
?>