# **天天游戏中心API文档**
---

* [规格说明](#规格说明)
* [http请求头部参数](#http请求头部参数)
* [请求&返回body实体](#body)
* [http返回header头部参数](#http返回header头部参数)
* [返回状态码](#返回状态码)
* [错误信息error](#错误信息error)
* [修订历史](#修订历史)
* [host配置文件地址](#host配置文件地址)
* [game_base_info](#game_base_info)
* [接口](#接口)
  * [1.启动app时预加载主页及其他信息](#api-1)
  * [2.精选](#api-2)
  * [3.游戏列表](#api-3)
  * [4.游戏详情](#api-4)
  * [5.分类](#api-5)
  * [6.热门分类游戏列表页](#api-6)
  * [7.分类的游戏列表](#api-7)
  * [8.专题列表页](#api-8)
  * [9.专题详情页](#api-9)
  * [10.礼包页](#api-10)
  * [11.我的礼包](#api-11)
  * [12.游戏的礼包列表](#api-12)
  * [13.礼包详情](#api-13)
  * [14.礼包领取](#api-14)
  * [15.活动](#api-15)
  * [16.首发](#api-16)
  * [17.搜索](#api-17)
  * [18.自动匹配](#api-18)
  * [19.游戏评论](#api-19)
  * [20.提交游戏评论](#api-20)
  * [21.数据中心](#api-21)
  * [22.检查更新](#api-22)
  * [23.游戏管理，检测所有游戏版本](#api-23)
  * [24.反馈信息展示](#api-24)
  * [25.提交反馈](#api-25)
  * [26.提交反馈图片](#api-26)

#### **规格说明**
|/|说明|
|-----|-------|
|版本|v4.0|
|协议版本|v3.0|
|调用方式|HTTP RESTFUL [GET POST PUT DELETE]|
|返回格式|二进制加密数据|
|返回数据|{ data:{}, message:{}, error:{}}只有data时，则直接返回data里面的数据|

<br>
#### **http请求头部参数**
|参数|说明|
|----|---------------|
|X-Client-Info|公共参数，包括如下：<br>uuid：设备唯一标识<br>imei：机器码<br>version：客户端版本<br>version_code：客户端版本代号<br>os_version：操作系统版本<br>device：设备型号<br>metrics：设备分辨率480X800<br>channel：渠道别名<br>access_token：用户登录后服务器返回的用户token，作每次请求的验证串|
|X-Update-Time|api最后更新时间|

<br>
<a name="body" />
#### **请求&返回body实体**
值为MCrypt(base64_encode(msgpack(data)))
> key为本地秘钥，data为post提交数据或返回数据（json格式）

<br>
#### **http返回header头部参数**
|参数|类型|说明|
|---|---|---|
|X-Links|{<br>"next_page":"http://api.example.com/x?x=x",<br>"last_page":"http://api.example.com/x?x=x"<br>}|上一页，最后一页链接（列表页数据接口会有该参数返回）|
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
#### **修订历史**
|版本|修改说明|修改人|
|---|---|---|
||||

<br>
#### **host配置文件地址**
http://cdn.example.com/ltbl/host
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
|alias|string|别名|
|cat|string|分类|
|package|string|游戏包名|
|md5|string|安装包MD5|
|size|int|安装包大小|
|version|string|应用版本|
|version_code|int|应用版本号|
|author|string|作者|
|icon|string|icon地址|
|feature|string|更新信息|
|summary|string|游戏介绍|
|download_link|string|下载链接|
|download_count|string|下载数|
|mark|string|角标链接|
|forum_id|int|社区id|


<br>
## **接口**

<a name="api-1" />
### 1.启动app时预加载主页及其他信息

请求地址：{server_host}/start

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
    "tops":[$data],
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
> 精选页/排行页/分类页$data数据格式分别与接口3,4和6的返回数据格式相同


<br>
<a name="api-2" />
### 2.精选
请求地址：{server_host}/index

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
        "type":"sliders",
        "data":[
            {
                "type":"game",
                "data":{
                    "image_url":"",
                    "id":1
                }
                    
            },
            {
                "type":"topic",
                "data":{
                    "image_url":"",
                    "id":2
                }
                    
            },
            ...
        ]
    },
    {
        "type":"tabs",
        "data":[
            {"title":"专题","type":"topic","url":""},
            {"title":"社区","type":"forum","url":""},
            {"title":"攻略","type":"strategy","url":""},
            {"title":"活动","type":"h5","url":""},
        ]
    },
    {
        "type":"s_push",
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
            "type":"topic",   // 其他类型game/gift/h5
            "image_url":"",
            "id":12,
            "link":""   // 跳转h5页面时的地址
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
<a name="api-3" />
### 3.排行
请求地址：{server_host}/games

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|rank|string|排行类型 单机/网游/最热/最新（offline/online/hot/new）|
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
<a name="api-4" />
### 4.游戏详情
请求地址：{server_host}/games/{id}

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
        "tabs":[
            {"title":"攻略","type":"news","url":""},
            {"title":"评测","type":"news","url":""},
            {"title":"新闻","type":"news","url":""}
        ]
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
<a name="api-5" />
### 5.分类
请求地址：{server_host}/cats

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
            {"id":"","title":"","color":"","image":"/xx/xx.png"},
            {"id":"","title":"","color":"","image":"/xx/xx.png"},
            {"id":"","title":"","color":"","image":"/xx/xx.png"},
            {"id":"","title":"","color":"","image":"/xx/xx.png"}
        ]
    },
    {
        "type":"all_cats",
        "data":[
            {
                "id":"",
                "title":"",
                "image":"",
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
                "image":"",
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
<a name="api-6" />
### 6.热门分类游戏列表页
请求地址：{server_host}/games/hotcats

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
<a name="api-7" />
### 7.分类的游戏列表
请求地址：{server_host}/cats/{id}

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
<a name="api-8" />
### 8.专题列表页
请求地址：{server_host}/topics

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
            "image":"/xxx/xx.png",
            "summary":"好游戏"
        }
    },
    {
        "type":"topic",
        "data":{
            "id":1,
            "title":"时空猎人",
            "image":"/xxx/xx.png",
            "summary":"好游戏"
        }
    },
    {
        "type":"topic",
        "data":{
            "id":1,
            "title":"时空猎人",
            "image":"/xxx/xx.png",
            "summary":"好游戏"
        }
    },
    ...
]
```

<br>
<a name="api-9" />
### 9.专题详情页
请求地址：{server_host}/topics/{id}

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
            "image":"/xxx/xx.png",
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
<a name="api-10" />
### 10.礼包页
请求地址：{server_host}/gifts

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
        "type":"sliders",
        "data":[
            {
                "type":"gift",
                "data":{
                    "image_url":"",
                    "id":1
                }
            },
            {
                "type":"gift",
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
                "icon":"/xxx/xx.png",
                "total":5000,
                "remain":2000
            },
            {
                "id":1,
                "title":"天天飞车",
                "icon":"/xxx/xx.png",
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
                "icon":"/xxx/xx.png",
                "gift_id":22,
                "gift_title":"黄金礼包",
                "total":5000,
                "remain":2000
            },
            {
                "id":1,
                "title":"天天飞车",
                "icon":"/xxx/xx.png",
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
                "icon":"/xxx/xx.png",
                "total":"5000",
                "remain":"4999"
            },
            {
                "id":"2",
                "title":"爸爸去哪2",
                "icon":"/xxx/xx.png",
                "total":"5000",
                "remain":"4999"
            },
        ]
    },
    {
        "type":"gifts_search_lists",
        "data":{
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
            "icon":"/xxx/xx.png",
            "total":5000,
            "remain":2000
        },
        {
            "id":1,
            "title":"天天飞车",
            "icon":"/xxx/xx.png",
            "total":5000,
            "remain":2000
        },
        ...
    ]
}
```


<br>
<a name="api-11" />
### 11.我的礼包
请求地址：{server_host}/mygifts

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
            "icon":"/xxx/xx.png",
            "gift_title":"",
            "code":"HSDKJFSNCMXZNJ232"
            "stocked_at":"2015-09-25 18:30:16",
            "unstocked_at":"2016-09-25 23:59:59"
        }
    },
    {
        "type":"my_gifts",
        "data":{
            "icon":"/xxx/xx.png",
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
<a name="api-12" />
### 12.游戏的礼包列表
请求地址：{server_host}/games/{game_id}/gifts

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
<a name="api-13" />
### 13.礼包详情
请求地址：{server_host}/gifts/{id}

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
<a name="api-14" />
### 14.礼包领取
请求地址：{server_host}/gifts/{id}/codes?by=random

|Request|Method : POST||
|---|---|---|
|参数名|类型|说明|
|/|/|/|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
返回数据格式
```
{
    "code":"SDKJFSZNXCZ234",
    "usage":"使用说明"
}
```

<br>
<a name="api-15" />
### 15.活动
请求地址：{server_host}/activity

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
            "banner":"/xxx/xx.png",
            "s_banner":"/xxx/xx.png",
            "link":"xxxx",
            "intro":"十一活动",
            "stocked_at":"2015-09-25 18:30:16",
            "unstocked_at":"2016-09-25 23:59:59"
        }
    },
    {
        "type":"activity",
        "data":{
            "id":2,
            "title":"国庆红包福利222",
            "banner":"/xxx/xx.png",
            "s_banner":"/xxx/xx.png",
            "link":"xxxx",
            "intro":"十一活动222",
            "stocked_at":"2015-09-25 18:30:16",
            "unstocked_at":"2016-09-25 23:59:59"
        }
    },
    ...
]
```

<a name="api-16" />
### 16.首发
请求地址：{server_host}/games/debut

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
<a name="api-17" />
### 17.搜索
请求地址：{server_host}/search

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
        {"id":"1","title":"爸爸去哪","icon":"/xxx/xx.png"},
        {"id":"2","title":"爸爸去哪2","icon":"/xxx/xx.png"},
        {"id":"3","title":"爸爸去哪3","icon":"/xxx/xx.png"},
        ...
    ]
}
```

<br>
<a name="api-18" />
### 18.自动匹配
请求地址：{server_host}/autocomplete

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
<a name="api-19" />
### 19.游戏评论
请求地址：{server_host}/games/{game_id}/comments

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
<a name="api-20" />
### 20.提交游戏评论
请求地址：{server_host}/games/{game_id}/comments

|Request|Method : POST||
|---|---|---|
|参数名|类型|说明|
|star|int|评分|
|content|string|评论内容|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
> 返回message信息，提交失败会有error信息

<br>
<a name="api-21" />
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
<a name="api-22" />
### 22.检查更新
请求地址：{server_host}/clients/last_release

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
    "version":"1.0",
    "version_code":"1000",
    "size":"1024",
    "download_link":"",
    "created_at":"",
    "download_link":"",
    "feature":"",
    "md5":"",
    "is_force":"false",
}
```

<br>
<a name="api-23" />
### 23.游戏管理，检测所有游戏版本
请求地址：{server_host}/games/match

|Request|Method : GET||
|---|---|---|
|参数名|类型|说明|
|data|string（json格式）|要匹配查询的游戏信息|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
data参数格式为
```
[
    {"package":"","version":"","version_code":""},
    {"package":"","version":"","version_code":""},
    ...
]
```
返回数据格式
```
[
    {game_base_info},
    {game_base_info},
    {game_base_info},
    ...
]
```

<br>
<a name="api-24" />
### 24.反馈信息展示
请求地址：{server_host}/feedbacks

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
        "type":"feedback",
        "data":{
            "content":"呵呵哒",
            "identifyUser":"user",  // 反馈人标识user:用户，system:系统，admin:管理员
            "image_url":"/xxx/xx.png",
            "thumb_url":"/xxx/xxx.png",     // 缩略图
            "created_at":"2015-09-25 18:30:16"
        }
    },
    {
        "type":"feedback",
        "data":{
            "content":"呵呵哒",
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
<a name="api-25" />
### 25.提交反馈
请求地址：{server_host}/feedbacks

|Request|Method : POST||
|---|---|---|
|参数名|类型|说明|
|content|string|反馈内容|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
> 返回message信息，提交失败会有error信息

<br>
<a name="api-26" />
### 26.提交反馈图片
请求地址：{server_host}/feedbacks/upload

|Request|Method : POST||
|---|---|---|
|参数名|类型|说明|
|image|file|图片文件|
|**Respone**|**DataType : json**||
|参数名|类型|说明|
> 返回message信息，提交失败会有error信息


<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
