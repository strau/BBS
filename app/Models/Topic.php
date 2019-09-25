<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category_id',
        'reply_count',
        'view_count',
        'last_reply_user_id',
        'order',
        'excerpt',
        'slug'
    ];

    // 关联话题分类
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 关联发布话题的用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 本地作用域允许我们定义通用的约束集合以便在应用中复用。
     * 要定义这样的一个作用域，只需简单在对应 Eloquent 模型方法前加上一个 scope 前缀，作用域总是返回 查询构建器。
     * 一旦定义了作用域，则可以在查询模型时调用作用域方法。
     * 在进行方法调用时不需要加上 scope 前缀。如以下代码中的 recent() 和 recentReplied()
     */

    /**
     * 根据不同的参数排序
     *
     * @param $query
     * @param $order
     * @return mixed
     * User: KANG
     * Date: 2019/9/25
     * Time: 20:24
     */
    public function scopeWithOrder($query, $order)
    {
        // 不同的排序使用不同的数据读取逻辑
        switch ($order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
        return $query;
    }

    /**
     * 按创建时间倒排序
     *
     * @param $query
     * @return mixed
     * User: KANG
     * Date: 2019/9/25
     * Time: 20:26
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * 按修改时间倒排序
     *
     * @param $query
     * @return mixed
     * User: KANG
     * Date: 2019/9/25
     * Time: 20:26
     */
    public function scopeRecentReplied($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }
}
