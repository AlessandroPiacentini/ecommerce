<?php
class Timer{
    
    

    private static $instance = null;

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new Timer();
        }
        return self::$instance;
    }

    private function __construct(){
    }
    
    public function stop(){
        $f=fopen("timer.txt", "w");
        fwrite($f, 0);
        fclose($f);
    }

    public function start(){
        
        $f=fopen("timer.txt", "w");
        fwrite($f, time());

        fclose($f);
    }

    public function getSecond(){
        $f=fopen("timer.txt", "r");
        $time = fread($f, filesize("timer.txt"));
        fclose($f);
        return time()-$time;
    }
}
?>
