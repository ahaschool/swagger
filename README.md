## lumen swagger api json lib

### controller中的写法
```php
/**
 * @swg\path get /api/test/get
 * @swg\tags ["测试分组"]
 * @swg\summary GET方式获取数据
 * @swg\req\param {"id": "param", "type": "string", "in": "path", "description": "编号"}
 * @swg\req\param {"name": "param", "type": "string", "in": "path", "description": "名称"}
 * @swg\res\schema {"mobile": {"description": "手机号","type": "string"}}
 * @swg\res\schema {"captcha": {"description": "验证码","type": "string"}}
 */
/**
 * @swg\path post /api/test/post
 * @swg\tags ["测试分组"]
 * @swg\summary POST方式获取数据
 * @swg\req\param {"name": "param", "in": "body", "description": "请求参数"}
 * @swg\req\schema {"mobile": {"description": "手机号","type": "string"}}
 * @swg\req\schema {"captcha": {"description": "验证码","type": "string"}}
 * @swg\res\schema {"mobile": {"description": "手机号","type": "string"}}
 * @swg\res\schema {"captcha": {"description": "验证码","type": "string"}}
 */
```

### model中的写法
```php
/**
 * @swg\definition AccessToken
 * @property string $user_id
 * @property string $client_id
 * @property string $revoked
 * @property string $expires_in
 * @property string $access_token
 */
```
