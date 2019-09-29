<?php
/**
 * 自定义辅助函数
 *
 * User: KANG
 * Date: 2019/7/18
 * Time: 17:22
 */

if (! function_exists('validate')) {
    /**
     * 使用laravel的验证器验证接收的数据
     *
     * @param array $vd 要验证的数据
     * @param array $vr 验证规则
     * @param array $vm 自定义的验证错误消息
     * @throws \App\Exceptions\ValidatorFailedException
     * User: KANG
     * Date: 2019/7/18
     * Time: 17:32
     */
    function validate($vd, $vr, $vm) {
        $validator = validator($vd, $vr, $vm);
        if ($validator->fails()) {
            //验证失败
            throw new \App\Exceptions\ValidatorFailedException(
                \App\Common\Res::response(\App\Common\Res::CODE_VERIFY_ERR_NOTMATCH,
                                                $validator->errors()->getMessages()));
        }
    }
}

if (! function_exists('verifyPassword')) {
    /**
     * 验证一段给定的未加密字符串与给定的哈希值是否一致
     *
     * @param string $password 未加密的密码
     * @param string $hashedPassword 加密后的密码
     * @return bool
     * User: KANG
     * Date: 2019/7/19
     * Time: 20:19
     */
    function verifyPassword($password, $hashedPassword) {
        return \Illuminate\Support\Facades\Hash::check($password, $hashedPassword);
    }
}

if (! function_exists('routeClass')) {
    /**
     * 将当前路由名称中的.替换为-
     *
     * @return mixed
     * User: KANG
     * Date: 2019/9/19
     * Time: 17:34
     */
    function routeClass()
    {
        return str_replace('.', '-', \Illuminate\Support\Facades\Route::currentRouteName());
    }
}

if (! function_exists('activeClass')) {
    /**
     * 根据路由名称和参数判断是否添加选中状态的class
     *
     * @return string
     * User: KANG
     * Date: 2019/9/19
     * Time: 17:34
     */
    function activeClass($route = null, $params = [], $class = 'active')
    {
        $r = $p = false;
        if ($route) {
            $r = \Illuminate\Support\Facades\Route::currentRouteName() === $route;
        } else {
            $r = true;
        }
        if (count($params) > 0) {
            foreach ($params as $key => $value) {
                $param = request()->$key;
                if (is_object($param)) {
                    $primary_key_name = $param->getKeyName();
                    $p = $param->$primary_key_name == $value;
                } else {
                    $p = $param == $value;
                }
            }
        } else {
            $p = true;
        }
        if ($r === true && $p === true) {
            return $class;
        }
        return '';
    }
}

if (! function_exists('makeExcerpt')) {
    /**
     * 根据内容生成摘要
     *
     * @return string
     * User: KANG
     * Date: 2019/9/19
     * Time: 17:34
     */
    function makeExcerpt($value, $length = 200)
    {
        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
        return str_limit($excerpt, $length);
    }
}

if (! function_exists('modelLink')) {
    /**
     * 获取链接到模型的a链接标签
     *
     * @param $title
     * @param $model
     * @param string $prefix
     * @return string
     * User: KANG
     * Date: 2019/9/29
     * Time: 19:41
     */
    function modelLink($title, $model, $prefix = '')
    {
        // 获取数据模型的复数蛇形命名
        $model_name = modelPluralName($model);

        // 初始化前缀
        $prefix = $prefix ? "/$prefix/" : '/';

        // 使用站点 URL 拼接全量 URL
        $url = config('app.url') . $prefix . $model_name . '/' . $model->id;

        // 拼接 HTML A 标签，并返回
        return '<a href="' . $url . '" target="_blank">' . $title . '</a>';
    }
}

if (! function_exists('modelPluralName')) {
    /**
     * 将模型的名字转成蛇形小写复数形式
     *
     * @param $model
     * @return string
     * User: KANG
     * Date: 2019/9/29
     * Time: 19:42
     */
    function modelPluralName($model)
    {
        // 从实体中获取完整类名，例如：App\Models\User
        $full_class_name = get_class($model);

        // 获取基础类名，例如：传参 `App\Models\User` 会得到 `User`
        $class_name = class_basename($full_class_name);

        // 蛇形命名，例如：传参 `User`  会得到 `user`, `FooBar` 会得到 `foo_bar`
        $snake_case_name = snake_case($class_name);

        // 获取子串的复数形式，例如：传参 `user` 会得到 `users`
        return str_plural($snake_case_name);
    }
}

if (! function_exists('modelAdminLink')) {
    /**
     * 获取链接到管理后台的模型的a链接标签
     *
     * @param $title
     * @param $model
     * @return string
     * User: KANG
     * Date: 2019/9/29
     * Time: 19:43
     */
    function modelAdminLink($title, $model)
    {
        return modelLink($title, $model, 'admin');
    }
}