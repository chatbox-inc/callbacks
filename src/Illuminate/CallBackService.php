<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/01/20
 * Time: 12:53
 */

namespace Chatbox\ColdBucks\Illuminate;
use Carbon\Carbon;
use Chatbox\ColdBucks\CallBackInterface;
use Chatbox\ColdBucks\CallBackTrait;


/**
 * @package Chatbox\CallBack\Illuminate
 */
class CallBackService implements CallBackInterface
{
    use CallBackTrait;

    protected function tableName(){
        throw new \Exception("table name not set");
    }

    protected function insert($token,callable $callable)
    {
        var_dump(serialize($callable));
        \DB::table($this->tableName())->insert([
            "token" => $token,
            "objects" => base64_encode(serialize($callable)),
            "created_at" => Carbon::now()
        ]);
    }

    protected function load(string $token):callable
    {
        $row = \DB::table($this->tableName())->where([
            "token" => $token,
        ])->first();
        if($row ){
            return unserialize(base64_decode($row->objects));
        }else{
            throw new Exception();
        }
    }

    public function delete($token)
    {
        $row = \DB::table($this->tableName())->where([
            "token" => $token,
        ])->delete();
    }

    public function flush(Carbon $expire_at)
    {
        \DB::table($this->tableName())->where([
            ["created_at","<",$expire_at],
        ])->delete();
    }


}