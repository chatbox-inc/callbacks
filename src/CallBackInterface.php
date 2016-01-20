<?php
namespace Chatbox\ColdBucks;
use Carbon\Carbon;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/01/20
 * Time: 11:45
 */
interface CallBackInterface
{
    /**
     * @param callable $callable
     * @return string
     */
    public function save(callable $callable):string;

    /**
     * @param string $token
     * @param array $params
     * @throws CallBackTokenNotFoundException
     * @return mixed
     */
    public function call(string $token,$params=[]);

    public function delete($token);

    public function flush(Carbon $expire_at);
}

class CallBackInsertFailureException extends \Exception{}

class CallBackTokenNotFoundException extends \Exception{}