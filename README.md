# CallBacks

複数リクエスト感でタスク等をシリアライズして再コールする仕組み。


Request A

````
$buckets = new MyCallBack();

$data = Carbon::now();
$token = $buckets->save($someCallableTask)
````

Request B

````
$buckets = new MyCallBack();

$result = $buckets->call($token)
````

## 注意

- クロージャはシリアライズ出来ません。
- 無名クラスはシリアライズ出来ません。


