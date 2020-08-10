## 安装
```shell script
composer require cloud-arrow/taoke -vvv
```
## 配置
首先去拼多多开放平台申请一个应用 申请地址，得到Client_id和Client_secret，然后去多多进宝绑定Client_id后可以调用接口接口文档，利用接口得到推广位pid

## 使用
```php
$clientId="xxxx";
$clientSecret="xxxx";

$service=new \CloudArrow\Taoke\Pinduoduo\Pinduoduo($clientId,$clientSecret);
```
#### 1.查询已经生成的推广位信息
```
$service->getPidList();
```
示例：
```json
{
    "p_id_query_response": {
        "p_id_list": [
            {
                "create_time": 1596975528,
                "pid_name": "推广位11384493_149491686",
                "p_id": "11384493_149491686",
                "status": 0
            },
            {
                "create_time": 1596975528,
                "pid_name": "推广位11384493_149491687",
                "p_id": "11384493_149491687",
                "status": 0
            },
            {
                "create_time": 1596975528,
                "pid_name": "推广位11384493_149491688",
                "p_id": "11384493_149491688",
                "status": 0
            },
            {
                "create_time": 1596975528,
                "pid_name": "推广位11384493_149491689",
                "p_id": "11384493_149491689",
                "status": 0
            },
            {
                "create_time": 1596975528,
                "pid_name": "推广位11384493_149491690",
                "p_id": "11384493_149491690",
                "status": 0
            }
        ],
        "total_count": 5,
        "request_id": "15970319187270305"
    }
}
```
## License
MIT