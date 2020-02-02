<?php
namespace NotificationDemon;

/**
 * Class ProductInfo
 * @package NotificationDemon
 * Descr: Класс задаёт структуру для хранения информации о товаре
 * в частности кол-во просматриваюющих людей страницу товара в данный момент времени.
 *
 * История просмтров детальной страницы хранится в Redis. Актуальность просмотров поддерживается сохранением
 * истории инкрементирования кол-ва простров (id-товара=>время инкрементирвоания+случайное значение).
 */
class ProductInfo
{

    private $redis;
    private $keyProductViewHistory;
    public static $DEFAULT_INTERVAL=60;
    public static $DEFAULT_INTERVAL_CLEAN=300;

    public function __construct(
        string $keyProductViewHistory='productViewHistory')
    {
        $this->redis = new \Predis\Client();
        if (!$this->redis->ping()) {
            throw Exception("Redis offline.");
        }
        $this->keyProductViewHistory= $keyProductViewHistory;
    }

    public function incrView(int $idItem){
        if($this->redis->zadd($this->keyProductViewHistory,$idItem,self::getTimeScore().':'.random_int(100000,999999))===1){
            return true;
        }
        return false;
    }
    public function delView($id){
        if($this->redis->zrem($this->keyProductViewHistory,$id)===1){
            return true;
        }
        return false;
    }

    public function getHistory(int$idItem){
        return $this->redis->zrangebyscore($this->keyProductViewHistory,$idItem,$idItem);
    }
    public function getAllHistory(array $options=['withscores'=>true,]){
        return $this->redis->zrangebyscore($this->keyProductViewHistory,0,'inf',$options);
    }
    public function getView(int $idItem,float $start){
        $history=$this->getHistory($idItem);
        $interval=self::$DEFAULT_INTERVAL;
        foreach ($history as $k=>$v){
            $history[$k]=explode(':',$v)[0];
        }

        $resAr=array_filter($history, function($v,$k) use($start,$interval){
            $v=(float)$v;
            return ($start-$v)<=$interval;
        }, ARRAY_FILTER_USE_BOTH);

        $res=count($resAr);


        if($res<=1){
            $res=$this->getFakeView();
        }
        return $res;
    }
    public function delOldView(float $interval){

        $history=$this->getAllHistory(['withscores'=>false,]);
        $start= self::getTimeScore();
        foreach ($history as $k=>$v){
            $id=$v;
            $time=explode(':',$v)[0];
            $history[$k]=[
                'time'=>$time,
                'id'=>$id,
            ];
        }

        $resAr=array_filter($history, function($v,$k) use($start,$interval){
            $time=(float)$v['time'];
            return ($start-$time>$interval);
        }, ARRAY_FILTER_USE_BOTH);

        foreach ($resAr as $k=>$v){
            $this->delView($v['id']);
        }
        return count($resAr);
    }
    public function getFakeView(){
        return random_int(9999,9999);
    }
    public function fillFixture(){
        for($id=1;$id!=10;++$id){
            $countItem=random_int(2,10);
            for($count=1;$count!=$countItem;++$count){
                $this->incrView($id);
            }
        }
    }

    public static function getTimeScore(bool $isFloat=true){
        return microtime($isFloat);
    }

    public function clear(){
        $this->redis->del($this->keyProductViewHistory);
    }
    public function __destruct() {
        $this->redis->quit();
    }
}