<?php 
include('Net/SSH2.php');

class TestClass{
    public static function sayHelloName($name){
        echo("hello ".$name);
    }

    public static function doSSH(){
        $ssh = new Net_SSH2('192.168.56.101');
        if (!$ssh->login('root', 'root')) {
            exit('Login Failed');
        }

        echo $ssh->exec('pwd');
        echo $ssh->exec('ls -la');
    }
}
?>