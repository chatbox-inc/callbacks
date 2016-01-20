<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/01/20
 * Time: 11:51
 */

namespace Chatbox\ColdBucks;


trait CallBackTrait
{
    abstract protected function insert($toekn, callable $callable):string;

    abstract protected function load(string $token):callable;


    public function save(callable $callable):string{
        $token = sha1(sha1(mt_rand()));
        $this->insert($token,$callable);
        return $token;
    }

    public function call(string $token,$params=[]){
        try{
            $callable = $this->load($token);
        }catch(CallBackTokenNotFoundException $e){
            throw $e;
        }
        return call_user_func_array($callable,$params);
    }

}

