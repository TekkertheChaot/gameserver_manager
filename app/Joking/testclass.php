<?php 

use phpseclib\Net\SSH2;


class TestClass{
    public static function sayHelloName($name){
        echo("hello ".$name);
    }

    public static function doSSH(){
        $ssh = new SSH2('192.168.56.101');
        if (!$ssh->login('root', 'root')) {
            exit('Login Failed');
        }

        echo(TestClass::getSSHResultWithLineBreaks($ssh->exec('ls -la')));
    }

    public static function getSSHResultWithLineBreaks(String $sshResult){
        return str_replace("\n", "<br>", $sshResult);
    }
}
?>