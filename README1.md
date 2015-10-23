# **苹果商店API文档**
---

#### **规格说明**
|/|说明|
|-----|-------|
|版本|v1.0|
|协议版本|v3.0|
|调用方式|HTTP RESTFUL [GET POST PUT DELETE]|
|返回格式|json|
|返回数据|{ data:{}, message:{}, error:{}}只有data时，则直接返回data里面的数据|

<br>
#### **http请求头部参数**
|参数|说明|
|----|---------------|
|X-Client-Info|公共参数，包括如下：<br>uuid：设备唯一标识<br>imei：机器码<br>version：客户端版本<br>version_code：客户端版本代号<br>os_version：操作系统版本<br>device：设备型号<br>metrics：设备分辨率480X800<br>channel：渠道别名<br>access_token：用户登录后服务器返回的用户token，作每次请求的验证串|
|X-Update-Time|api最后更新时间|

<br>
#### **请求body实体(POST,PUT请求时需要)**
param:{......}
param值为msgpack(base64_encode(xxx(key+data)))
> key为本地秘钥，data为post提交数据

<br>
#### **http返回header头部参数**
|参数|类型|说明|
|---|---|---|
|Link（接口2-8会有该参数返回）|{<br>"next_page":"api.example.com/x?x=x",<br>"last_page":"api.example.com/x?x=x"<br>}|上一页，最后一页链接|
|X-RateLimit-Limit|int(5000)|API访问限制次数|
|X-RateLimit-Remaining|int(4999)|访问剩余次数|

<br>
#### **修订历史**
|版本|修改说明|修改人|
|---|---|---|
||||

<br>
#### **host配置文件地址**
http://cdn.example.com/ltbl/host

<br>
#### **app_base_info**
|参数名|类型|说明|
|---|---|---|
|id|int|应用ID|
|appstore_id|int|appstore ID|
|file_size_bytes|int|应用大小单位字节|
|name|string|应用名称|
|alias|string|别名|
|package|string|应用包名|
|version|string|应用版本|
|version_code|int|应用版本号|
|author|string|作者|
|price|float|应用价格|
|icon_urls|string|icon地址|
|view_url|string|appstore应用地址|
|reviews|string|一句话点评|
|average_user_rating|int|应用评分|
|average_user_rating|int|应用评分|
|type|string|apps=>应用，games=>游戏|
|release_date|date|应用发布日期|

<br>
#### **使用前说明**
- 接口1为app预加载数据接口（lua脚本组装）
- 接口2-8，前端可用于列表分页时调取
- 接口9-10为共享api接口，任何项目都可以调用

<br>
## **接口**
1.启动app时预加载主页及其他信息

请求地址：{server_host}/boostrap

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
|type|string|类型tabs/banner/app/topic(选项卡/轮播图/应用或游戏/专题)|
|data|dict/list|各个类型的数据|
返回数据格式
```json
{
    "index":[$data],
    "app":[$data],
    "games":[$data],
    "ranking":[$data]
}
```
$data数据格式
```
[
    {
        "type":"tabs",
            "data":[
                {"title":"付费","activate":"true","url":"/xxx/xxx"},
                {"title":"免费","activate":"false","url":"/xxx/xxx"},
                {"title":"畅玩","activate":"false","url":"/xxx/xxx"}
        ]
    },
        {
            "type":"banner",
            "data":[
                {
                    "link":"",
                    "image_url":"",
                    "app_id":1
                },
                {
                    "link":"",
                    "image_url":"",
                    "app_id":2
                }
                ...
            ]
        },
        {
            "type":"app",
            "data":"{app_base_info}"
        },
        {
            "type":"topic",
            "data":{
                "image_url":"",
                "topic_id":12
            }
    },
    ...
]
```
> 注：接口2返回数据跟data结构相同 

<br>
2.首页精选

请求地址：{server_host}/index

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|limit|int|广告个数|
|offset|int|偏移量|
|**Respone**|**DataType : json**||
||

<br>
3.首页专题列表

请求地址：{server_host}/topics

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|limit|int|广告个数|
|offset|int|偏移量|
|**Respone**|**DataType : json**||
|返回数据格式|||
```
[
    {
        "title":"周年盛典版震撼开启",
        "image_url":"",
        "topic_id":12
    },
    {
        "title":"周年盛典版震撼开启xx",
        "image_url":"",
        "topic_id":13
    }
    ...
]
```

<br>
4.专题详情页

请求地址：{server_host}/topics/{id}

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|limit|int|广告个数|
|offset|int|偏移量|
|**Respone**|**DataType : json**||
|返回数据格式|||
|待定|||

<br>
5.应用列表

请求地址：{server_host}/software

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|limit|int|广告个数|
|offset|int|偏移量|
|type|string|类型 必备/软件最新/软件排行（necessary/new/rank）|
|**Respone**|**DataType : json**||
|返回数据格式|||
|[<br>{app_base_info},<br>{app_base_info},<br>...<br>]|||

<br>
6.游戏列表

请求地址：{server_host}/games

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|limit|int|广告个数|
|offset|int|偏移量|
|type|string|类型 大作/游戏最新/游戏排行（epic/new/rank）|
|**Respone**|**DataType : json**||
|返回数据格式|||
|[<br>{app_base_info},<br>{app_base_info},<br>...<br>]|||

<br>
7.榜单列表

请求地址：{server_host}/ranking

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|limit|int|广告个数|
|offset|int|偏移量|
|type|string|类型 付费/免费/畅销（pay/free/hot）|
|**Respone**|**DataType : json**||
|返回数据格式|||
|[<br>{app_base_info},<br>{app_base_info},<br>...<br>]|||

<br>
8.软件/游戏分类

请求地址：{server_host}/ranking

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|type|string|分类类型，应用/游戏(apps/games)|
|**Respone**|**DataType : json**||
|返回数据格式|||
```
[
    {
        "title":"音乐",
        "image":"/xxx/xxx/xx.png",
        "resource_count":2000
    },
    {
        "title":"社交",
        "image":"/xxx/xxx/xx.png",
        "resource_count":2001
    }
    ...
]
```

<br>
9.苹果应用商店应用列表接口（可复用）

请求地址：{server_host}/apps

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|param|json|包含过滤，查询，排序，分页信息|
|**Respone**|**DataType : json**||
|返回数据格式|||
|[<br>{app_info},<br>{app_info},<br>...<br>]|||
注：param参数格式说明
```
{
    "field":["id","title","icon"],
    "filter":[],
    "sort":{"created_at":"desc","price":"desc"},
    "limit":10,
    "offset":0
}
```
- field只能是app_base_info中存在的字段，为空时返回字段为app_base_info对应全部字段；
- filter查询条件参数格式参见http://document.thinkphp.cn/manual_3_2.html#query

<br>
10.应用详情页

请求地址：{server_host}/apps/{id}

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|**Respone**|**DataType : json**||
|返回数据格式|||
```
{
    {app_base_info}
    "screen_shots":[
        "/xxxx/xxx.png",
        "/xxxx/xxx.png"
        ...
    ],
    "guess_you_favor":[
        {
            "id":"22",
            "icon_urls":"",
            "name":"我叫MT"
        },
        {
            "id":"23",
            "icon_urls":"",
            "name":"我叫MT2"
        }
        ...
    ],
    "same_author":[
        {
            "id":"22",
            "icon_urls":"",
            "name":"我叫MT"
        },
        {
            "id":"23",
            "icon_urls":"",
            "name":"我叫MT2"
        }
        ...
    ]
}
```

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
