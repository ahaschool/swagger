## lumen swagger api json lib

### controller中的写法
```php
/**
 * @swg\path post /api/test/auth
 * @swg\tags ["课程采购模块"]
 * @swg\summary 采集活动领取
 * @swg\req\param {"name": "param", "in": "body", "description": "请求参数"}
 * @swg\req\schema {"mobile": {"description": "手机号","type": "string"}}
 * @swg\req\schema {"captcha": {"description": "验证码","type": "string"}}
 * @swg\res\schema {"mobile": {"description": "手机号","type": "string"}}
 * @swg\res\schema {"captcha": {"description": "验证码","type": "string"}}
 */
/**
 * @swg\path get /api/test/auth
 * @swg\tags ["课程采购模块"]
 * @swg\summary 采集活动领取
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
