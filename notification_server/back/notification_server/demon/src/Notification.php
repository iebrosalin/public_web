<?php
namespace NotificationDemon;

class Notification
{

    private $redis;
    private $key;
    private static $ENDUNIXTIME=2147405755;
    private static $MAXORDERITEMS=999999;
    private static $DEFAULTCOUNT=2;
    public function __construct(string $key='notification')
    {
        $this->redis = new \Predis\Client();
        $this->key= $key;
        if (!$this->redis->ping()) {
            throw Exception("Redis offline.");

        }
    }

    public function push($data){
        if(count($data)>self::$MAXORDERITEMS){
            $data=array_slice($data,0,self::$MAXORDERITEMS);
        }
        foreach ($data as $score=>$members){
            if($this->redis->zadd($this->key,$score,$members)==0){

                return "Error";
            }
        }
    }
    public static function getTimeScore(){

        return microtime(TRUE);
    }
    public function getByScore($start=0, $stop=-1,$options=['withscores'=>false,]){
        return $this->redis->zrangebyscore($this->key, $start, $stop, $options);
    }
    public function getByRank($start=0, $stop=-1,$options=['withscores'=>false,]){
        return $this->redis->zrange($this->key, $start, $stop, $options);
    }
    public function remByScore( $start=0,$stop=-1){
        return $this->redis->zremrangebyscore($this->key,$start,$stop);
    }
    public function remByRank( $start=0,$stop=-1){
        return $this->redis->zremrangebyrank($this->key,$start,$stop);
    }
    public function getKey(){
        return $this->key;
    }
    public function getEndUnixTime(){
        return self::$ENDUNIXTIME;
    }
    public function getMaxOrderItems(){
        return self::$MAXORDERITEMS;
    }
    public function getDefaultCount(){
        return self::$DEFAULTCOUNT;
    }
    public function clear(){
        $this->redis->del($this->key);
    }
    public function __destruct() {
        $this->redis->quit();
    }
}