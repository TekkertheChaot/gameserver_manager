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

        $returned = $ssh->exec('ls -la');
        var_dump($returned);
        die();
    }
}
?>