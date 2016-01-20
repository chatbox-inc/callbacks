<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/01/20
 * Time: 11:53
 */

namespace Chatbox\ColdBucks\Illuminate;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SchemaBuilder
{
    public function create($table)
    {
        if(!Schema::hasTable($table)){
            Schema::create($table,function(Blueprint $blueprint){
                $blueprint->increments("id");
                $blueprint->string("token");
                $blueprint->longText("objects");
                $blueprint->timestamp("created_at");

                $blueprint->unique("token");
            });
        }
    }

    public function drop($table)
    {
        Schema::dropIfExists($table);

    }


}