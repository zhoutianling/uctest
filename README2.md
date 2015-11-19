# **天天游戏中心API文档**
---

* [<strong>天天游戏中心API文档</strong>](#天天游戏中心api文档)
    * [<strong>规格说明</strong>](#规格说明)
    * [<strong>http请求头部参数</strong>](#http请求头部参数)
    * [<strong>http返回header头部参数</strong>](#http返回header头部参数)
    * [<strong>返回状态码</strong>](#返回状态码)
    * [<strong>错误信息error</strong>](#错误信息error)
    * [加密协议](#加密协议)
    * [<strong>host配置文件地址</strong>](#host配置文件地址)
    * [<strong>game_base_info</strong>](#game_base_info)
* [<strong>接口</strong>](#接口)
  * [1.启动app时预加载主页及其他信息](#1启动app时预加载主页及其他信息)
  * [2.精选](#2精选)
  * [3.排行](#3排行)
  * [4.游戏详情（id或包名搜索）](#4游戏详情id或包名搜索)
  * [5.分类](#5分类)
  * [6.热门分类游戏列表页](#6热门分类游戏列表页)
  * [7.分类的游戏列表](#7分类的游戏列表)
  * [8.专题列表页](#8专题列表页)
  * [9.专题详情页](#9专题详情页)
  * [10.礼包页](#10礼包页)
  * [11.我的礼包](#11我的礼包)
  * [12.游戏的礼包列表](#12游戏的礼包列表)
  * [13.礼包详情](#13礼包详情)
  * [14.礼包领取](#14礼包领取)
  * [15.活动](#15活动)
  * [16.首发](#16首发)
  * [17.搜索](#17搜索)
  * [18.自动匹配](#18自动匹配)
  * [19.游戏评论](#19游戏评论)
  * [20.提交游戏评论](#20提交游戏评论)
  * [21.数据中心](#21数据中心)
  * [22.检查更新](#22检查更新)
  * [23.游戏管理](#23游戏管理)
  * [24.反馈信息展示](#24反馈信息展示)
  * [25.提交反馈](#25提交反馈)


#### **规格说明**
|/|说明|
|-----|-------|
|版本|v4.0|
|协议版本|v3.0|
|调用方式|HTTP RESTFUL [GET POST PUT DELETE]|
|返回格式|二进制加密数据|
|返回数据|{data:{}, message:{}, error:{}}|

<br>
#### **http请求头部参数**
|参数|说明|
|----|---------------|
|X-Client-Info|公共参数，包括如下：<br>uuid：设备唯一标识<br>imei：机器码<br>version：客户端版本<br>version_code：客户端版本代号<br>os_version：操作系统版本<br>device：设备型号<br>metrics：设备分辨率480X800<br>channel：渠道别名<br>access_token：用户登录后服务器返回的用户token，作每次请求的验证串|
|X-Update-Time|api最后更新时间|

<br>
#### **http返回header头部参数**
|参数|类型|说明|
|---|---|---|
|X-Links|{<br>"next_page":"http://api.example.com/x?x=x",<br>"last_page":"http://api.example.com/x?x=x"<br>}|下一页，最后一页链接（列表页数据接口会有该参数返回）|
|X-Update-Time|2015-09-09 10:10:00|api最后更新时间|
|X-Retry-After|3600(s)|服务器恢复时间（503错误时会返回该参数）|

#### **返回状态码**
|status值|说明|
|---|---|
|200|get请求成功|
|201|post请求成功，并创建服务器资源|
|301|原url已废弃，跳转至资源所在处url（永久）|
|302|重定向url，并发起get请求（暂时）|
|303|允许post请求|
|304|请求成功，但不更新内容|
|400|请求错误，当header参数格式错误或body解析错误|
|401|请求未授权|
|403|请求被拒绝|
|404|找不到资源|
|405|请求方式错误|
|408|请求超时|
|413|请求body实体太大|
|414|请求url太长|
|422|参数错误，返回error信息|
|500|服务器出错|
|502|无法链接服务器|
|503|服务器维护中，header会有服务器恢复时间Retry-After参数|
|504|网关超时|

<br>
#### **错误信息error**
|错误名称|描述|
|---|---|
|missing|资源不存在|
|missing_field|缺少参数|
|invalid|格式错误或参数无效|
|already_exists|字段（唯一索引）存在相同值|
```
{
    "message": "验证错误",
    "error": [
        {
        "field": "title",
        "code": "missing_field"
        }
    ]
}
```

<br>
#### 加密协议

AES 128位 CBC 加密

|变量|值|
|---|---|
|KEY|待定|
|IV|为客户端version_code|
|SALT|nil|

```
加密
aes.encrypt(msgpack.pack(JSON明文))

解密
aes.decrypt(msgpack.unpack(JSON密文))
```

<br>
#### **host配置文件地址**
http://apps.ttigame.com/hosts.json
json文件，格式如下
```
{
    "gcenter_host":"http://www.example.com",     // 服务器host地址
    "ucenter_host":"http://www.example.com",    // 用户中心host地址
    "bbs_host":"http://www.example.com",        // 社区host地址
    "dcenter_host":"http://www.example.com"     // 数据中心host地址
}
```

<br>
#### **game_base_info**
|参数名|类型|说明|
|---|---|---|
|id|int|应用ID|
|name|string|应用名称|
|cat_name|string|分类|
|package_name|string|游戏包名|
|package_md5|string|安装包MD5|
|package_size|int|安装包大小|
|version_name|string|应用版本|
|version_code|int|应用版本号|
|icon_url|string|icon地址|
|changelog|string|更新信息|
|description|string|游戏介绍|
|download_url|string|下载链接|
|download_count|int|下载数|
|corner_url|string|角标链接|
|group_id|int|社区小组id，为0时不存在社区|
|has_gifts|int|1表示存在礼包，0表示不存在|
|mark|string|游戏标识（礼包/社区/攻略...）|



<br>
## **接口**

### 1.启动app时预加载主页及其他信息

请求地址：{gcenter_host}/start

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
{
    "necessary":[$data],   // 精选必玩数据（第一次启动时有该数据）
    "index":[$data],
    "ranking":[$data],
    "cats":[$data]
}
```
> 精选必玩data数据格式为
```
[
    {game_base_info},
    {game_base_info},
    {game_base_info},
    ...
]
```
> 精选页/排行页/分类页$data数据格式分别与接口2,3和5的返回数据格式相同


<br>
### 2.精选
请求地址：{gcenter_host}/index

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
[
    {
        "type":"carousel",
        "data":[
            {
                "click_type":"game", // 游戏详情/专题/话题/礼包/h5(game/topic/discussion/gift/h5)
                "data":{
                    "image_url":"",
                    "id":1,
                    "url":""    // h5地址（可为空）
                }
            },
            {
                "click_type":"topic",
                "data":{
                    "image_url":"",
                    "id":2,
                    "url":""
                }
            },
            ...
        ]
    },
    {
        "type":"entry",
        "data":[
            {
                "page_name":"YM-ZT", // 页面别名
                "title":"专题",
                "id":"",            // ID 适用于 游戏ID，专题ID，分类ID,可为空
                "color":"D94600"    // 颜色，RGB值
            },
            {
                "page_name":"YM-SWD",
                "title":"社区",
                "id":"",
                "color":"006000"
            },
            {
                "page_name":"YM-GB",
                "title":"攻略",
                "id":"",
                "color":"f75c54"
            },
            {
                "page_name":"活动列表页",
                "title":"活动",
                "id":"",
                "color":"930093"
            }
        ]
    },
    {
        "type":"super_push",
        "data":"{game_base_info}"
    },
    {
        "type":"hot",
        "data":[
            "{game_base_info}",
            "{game_base_info}",
            "{game_base_info}",
            ...
        ]
    },
    {
        "type":"banner",
        "data":{
            "click_type":"game", // 游戏详情/专题/话题/礼包/h5(game/topic/discussion/gift/h5)
            "data":{
                "mark":"最新活动", // 左上角标示文字
                "color":"D94600",  // 左上角标示背景颜色
                "image_url":"",
                "id":1,
                "url":""    // h5地址（可为空）
            }
        }
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    ...
]
```

<br>
### 3.排行
请求地址：{gcenter_host}/ranking

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|type|string|排行类型 单机/网游/最热/最新（offline/online/hot/new）|
|page|int|页数|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
[
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    ...
]
```

<br>
### 4.游戏详情（id或包名搜索）
请求地址：{gcenter_host}/games/{id/package}

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
{
    "type":"game_detail",
    "data":{
        {game_base_info},
        "gifts":[
            {"id":"1","title":"爸爸去哪游戏礼包"},
            {"id":"2","title":"爸爸去哪游戏礼包2"},
            ...
        ],
        "screenshots":[
            "/xxxx/xxx.png",
            "/xxxx/xxx.png"
            ...
        ],
        "game_recommend":[
            {
                "id":"22",
                "icon_url":"",
                "name":"我叫MT"
            },
            {
                "id":"23",
                "icon_url":"",
                "name":"我叫MT2"
            }
            ...
        ],
        "hot_tags":[
            {"id":"1","title":"3D"},
            {"id":"2","title":"竞技"},
            {"id":"3","title":"音乐"},
            ...
        ],
        "game_rating":{
            "star1_count":"100",
            "star2_count":"100",
            "star3_count":"100",
            "star4_count":"100",
            "star5_count":"500"
        }
    }
}
```

<br>
### 5.分类
请求地址：{gcenter_host}/cats

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
[
    {
        "type":"hot_cats",
        "data":[
            {"id":"","title":"","color":"","image_url":"/xx/xx.png"},
            {"id":"","title":"","color":"","image_url":"/xx/xx.png"},
            {"id":"","title":"","color":"","image_url":"/xx/xx.png"},
            {"id":"","title":"","color":"","image_url":"/xx/xx.png"}
        ]
    },
    {
        "type":"all_cats",
        "data":[
            {
                "id":"",
                "title":"",
                "image_url":"",
                "tags":[
                    {"id":"","title":""},
                    {"id":"","title":""},
                    {"id":"","title":""},
                    ...
                ]
            },
            {
                "id":"",
                "title":"",
                "image_url":"",
                "tags":[
                    {"id":"","title":""},
                    {"id":"","title":""},
                    {"id":"","title":""},
                    ...
                ]
            },
            ...
        ]
    }
]
```

<br>
### 6.热门分类游戏列表页
请求地址：{gcenter_host}/hotcats

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|id|int|热门分类id|
|page|int|页数|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
[
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    ...
]
```

<br>
### 7.分类的游戏列表
请求地址：{gcenter_host}/cats/{id}

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|tag_id|int|标签id|
|sort|排序|全部/最新/最热（all/new/hot）|
|page|int|页数|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
[
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    ...
]
```

<br>
### 8.专题列表页
请求地址：{gcenter_host}/topics

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|page|int|页数|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式（第二个开始为往期专题）
```
[
    {
        "type":"topic",
        "data":{
            "id":1,
            "title":"时空猎人",
            "image_url":"/xxx/xx.png",
            "summary":"好游戏"
        }
    },
    {
        "type":"topic",
        "data":{
            "id":1,
            "title":"时空猎人",
            "image_url":"/xxx/xx.png",
            "summary":"好游戏"
        }
    },
    {
        "type":"topic",
        "data":{
            "id":1,
            "title":"时空猎人",
            "image_url":"/xxx/xx.png",
            "summary":"好游戏"
        }
    },
    ...
]
```

<br>
### 9.专题详情页
请求地址：{gcenter_host}/topics/{id}

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
[
    {
        "type":"topic_detail",
        "data":{
            "id":1,
            "title":"时空猎人",
            "image_url":"/xxx/xx.png",
            "summary":"好游戏",
            "updated_at":""
        }
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    ...
]
```

<br>
### 10.礼包页
请求地址：{gcenter_host}/gifts

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|q|string|搜索关键字（可选）|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
没有参数时，为礼包中心页，返回数据格式
```
[
    {
        "type":"carousel",
        "data":[
            {
                "clic-type":"gift",
                "data":{
                    "image_url":"",
                    "id":1
                }
            },
            {
                "click-type":"gift",
                "data":{
                    "image_url":"",
                    "id":2
                }
                    
            },
            ...
        ]
    },
    {
        "type":"hot_gifts",
        "data":[
            {
                "id":1,
                "title":"天天飞车",
                "icon_url":"http://xxx.com/xxx/xx.png",
                "total":5000,
                "remain":2000
            },
            {
                "id":1,
                "title":"天天飞车",
                "icon_url":"http://xxx.com/xxx/xx.png",
                "total":5000,
                "remain":2000
            },
            ...
        ]
    },
    {
        "type":"new_gifts",
        "data":[
            {
                "id":1,
                "title":"天天飞车",
                "icon_url":"/xxx/xx.png",
                "gift_id":22,
                "gift_title":"黄金礼包",
                "total":5000,
                "remain":2000
            },
            {
                "id":1,
                "title":"天天飞车",
                "icon_url":"/xxx/xx.png",
                "gift_id":22,
                "gift_title":"黄金礼包",
                "total":5000,
                "remain":2000
            },
            ...
        ]
    }
]
```
当传入搜索关键字q且有搜索匹配结果时，返回数据格式为
```
[
    {
        "type":"gifts_search_ofgame",
        "data":[
            {
                "id":"1",
                "title":"爸爸去哪",
                "icon_url":"/xxx/xx.png",
                "total":"5000",
                "remain":"4999"
            },
            {
                "id":"2",
                "title":"爸爸去哪2",
                "icon_url":"/xxx/xx.png",
                "total":"5000",
                "remain":"4999"
            },
        ]
    },
    {
        "type":"gifts_search_lists",
        "data":{
            "id":111,
            "title":"爸爸去哪礼包",
            "content":"礼包内容",
            "usage":"使用说明",
            "total":"5000",
            "remain":"4999",
            "is_received":"false",
            "stocked_at":"2015-09-25 18:30:16",
            "unstocked_at":"2016-09-25 23:59:59"
        }
    },
    {
        "type":"gifts_search_lists",
        "data":{
            "id":222,
            "title":"爸爸去哪礼包",
            "content":"礼包内容",
            "usage":"使用说明",
            "total":"5000",
            "remain":"4999",
            "is_received":"false",
            "stocked_at":"2015-09-25 18:30:16",
            "unstocked_at":"2016-09-25 23:59:59"
        }
    },
    ...
]
```
当传入搜索关键字q但搜索匹配结果为空时，返回数据格式为
```
{
    "type":"hot_gifts",
    "data":[
        {
            "id":1,
            "title":"天天飞车",
            "icon_url":"/xxx/xx.png",
            "total":5000,
            "remain":2000
        },
        {
            "id":1,
            "title":"天天飞车",
            "icon_url":"/xxx/xx.png",
            "total":5000,
            "remain":2000
        },
        ...
    ]
}
```


<br>
### 11.我的礼包
请求地址：{gcenter_host}/gifts?owner={user_id}

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
[
    {
        "type":"my_gifts",
        "data":{
            "id":111,
            "icon_url":"/xxx/xx.png",
            "gift_title":"",
            "code":"HSDKJFSNCMXZNJ232"
            "stocked_at":"2015-09-25 18:30:16",
            "unstocked_at":"2016-09-25 23:59:59"
        }
    },
    {
        "type":"my_gifts",
        "data":{
            "id":2222,
            "icon_url":"/xxx/xx.png",
            "gift_title":"",
            "code":"HSDKJFSNCMXZN12J232"
            "stocked_at":"2015-09-25 18:30:16",
            "unstocked_at":"2016-09-25 23:59:59"
        }
    },
    ...
]
```

<br>
### 12.游戏的礼包列表
请求地址：{gcenter_host}/games/{game_id}/gifts

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
[
    {
        "type":"game_gifts_summary",
        "data":{
            {game_base_info},
            "total":"5000",
            "received_count":2,
        }
    },
    {
        "type":"game_gifts_lists",
        "data":{
            "id":111,
            "title":"爸爸去哪礼包",
            "content":"礼包内容",
            "usage":"使用说明",
            "total":"5000",
            "remain":"4999",
            "is_received":"false",
            "stocked_at":"2015-09-25 18:30:16",
            "unstocked_at":"2016-09-25 23:59:59"
        }
    },
    ...
]
```

<br>
### 13.礼包详情
请求地址：{gcenter_host}/gifts/{id}

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
{
    "type":"gifts_detail",
    "data":{
        {game_base_info},
        "gift_id":111,
        "gift_title":"爸爸去哪礼包",
        "gift_content":"礼包内容",
        "usage":"使用说明",
        "total":"5000",
        "remain":"4999",
        "code":"SDFHSDKFH32423UKH", //当is_received为true的时候存在
        "is_received":"false",
        "stocked_at":"2015-09-25 18:30:16",
        "unstocked_at":"2016-09-25 23:59:59"
    }
}
```

<br>
### 14.礼包领取
请求地址：{gcenter_host}/gifts/{id}/code

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
{
    "type":"get_gift_code",
    "data":{
        "code":"SDKJFSZNXCZ234",
        "usage":"使用说明",
        "content":"礼包内容",
    }
}
```

<br>
### 15.活动
请求地址：{gcenter_host}/activities

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
[
    {
        "type":"activity",
        "data":{
            "id":1,
            "title":"国庆红包福利",
            "image_url":"/xxx/xx.png",
            "big_image_url":"/xxx/xx.png",
            "url":"xxxx",
            "summary":"十一活动",
            "stocked_at":"2015-09-25 18:30:16",
            "unstocked_at":"2016-09-25 23:59:59"
        }
    },
    {
        "type":"activity",
        "data":{
            "id":2,
            "title":"国庆红包福利222",
            "image_url":"/xxx/xx.png",
            "big_image_url":"/xxx/xx.png",
            "url":"xxxx",
            "summary":"十一活动222",
            "stocked_at":"2015-09-25 18:30:16",
            "unstocked_at":"2016-09-25 23:59:59"
        }
    },
    ...
]
```

<br>
### 16.首发
请求地址：{gcenter_host}/debuts

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|page|int|页数|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
[
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    ...
]
```

<br>
### 17.搜索
请求地址：{gcenter_host}/search

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|q|string|搜索关键字|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
q为空时，返回数据格式
```
[
    {
        "type":"hot_words",
        "data":[
            {"id":"1","word":"爸爸去哪"},
            {"id":"2","word":"爸爸去哪2"},
            {"id":"3","word":"爸爸去哪3"},
            ...
        ]
    },
    {
        "type":"hot_tags",
        "data":[
            {"id":"1","title":"3D"},
            {"id":"2","title":"竞技"},
            {"id":"3","title":"音乐"},
            ...
        ]
    },
    {
        "type":"search_top10",
        "data":[
            {game_base_info},
            {game_base_info},
            {game_base_info},
            ...
        ]
    }
]
```
q不为空时且有搜索结果，返回数据格式
```
[
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    {
        "type":"game",
        "data":"{game_base_info}"
    },
    ...
]
```
q不为空时但搜索结果为空，返回数据格式
```
{
    "type":"search_null",
    "data":[
        {"id":"1","title":"爸爸去哪","icon_url":"/xxx/xx.png"},
        {"id":"2","title":"爸爸去哪2","icon_url":"/xxx/xx.png"},
        {"id":"3","title":"爸爸去哪3","icon_url":"/xxx/xx.png"},
        ...
    ]
}
```

<br>
### 18.自动匹配
请求地址：{gcenter_host}/search/autocomplete

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|q|string|匹配关键字|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
[
    {
        "type":"query_ads",
        "data":{game_base_info}
    },
    {
        "type":"query_data",
        "data":[
            "饿了么",
            "饿狼传说",
            "饿的倚天",
            ...
        ]
    }
]
```

<br>
### 19.游戏评论
请求地址：{gcenter_host}/games/{game_id}/comments

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
[
    {
        "type":"comments",
        "data":{
            "nickname":"方枪枪",
            "avatar":"/xx/xx.png",
            "content":"好游戏，很好玩",
            "device":"三星s7568",
            "star":4,
            "created_at":"2015-09-25 18:30:16"
        }
    }
    ...
]
```

<br>
### 20.提交游戏评论
请求地址：{gcenter_host}/games/{game_id}/comments

|Request|Method : POST||
|---|---|---|
|参数名|类型|说明|
|star|int|评分|
|content|string|评论内容|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
> 返回message信息，提交失败会有error信息

<br>
### 21.数据中心
请求地址：{dcenter_host}

|Request|Method : POST||
|---|---|---|
|参数名|类型|说明|
|data|string|操作字符串|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
|/|/|/|

<br>
### 22.检查更新
请求地址：{gcenter_host}/clients/releases/latest

|Request|Method : GET||
|---|---|---|
|/|/|/|
|参数名|类型|说明|
|data|string|操作字符串|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
{
    "type":"update",
    "data":{
        "version_name":"1.0",
        "version_code":"1000",
        "package_size":"1024",
        "download_link":"",
        "created_at":"",
        "download_link":"",
        "changelog":"",
        "package_md5":""
    }
}
```

<br>
### 23.游戏管理
请求地址：{gcenter_host}/game/manage

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|data|string（json格式）|要匹配查询的游戏信息|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
with参数格式为
```
[
    {"package_name":"","version_name":"","version_code":""},
    {"package_name":"","version_name":"","version_code":""},
    ...
]
```
返回数据格式
```
{
   "type":"game_manage",
   "data":[
      "{game_base_info}",
      "{game_base_info}",
      "{game_base_info}",
      ...
   ]
}
```

<br>
### 24.反馈信息展示
请求地址：{gcenter_host}/feedbacks

|Request|Method : get||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
[
    {
        "type":"text_feedback",
        "data":{
            "content":"呵呵哒",
            "identifyUser":"user",  // 反馈人标识user:用户，system:系统，admin:管理员
            "created_at":"2015-09-25 18:30:16"
        }
    },
    {
        "type":"image_feedback",
        "data":{
            "identifyUser":"user",
            "image_url":"/xxx/xx.png",
            "thumb_url":"/xxx/xxx.png",
            "created_at":"2015-09-25 18:30:16"
        }
    },
    ...
]
```

<br>
### 25.提交反馈
请求地址：{gcenter_host}/feedbacks

|Request|Method : POST||
|---|---|---|
|参数名|类型|说明|
|content|string 或者 file|反馈内容|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
> 返回message信息，提交失败会有error信息

<br>

