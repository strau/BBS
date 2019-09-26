<?php

namespace App\Observers;

use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateSlug;
use App\Models\Topic;
use Illuminate\Support\Facades\Log;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic)
    {
        $topic->title = clean($topic->title, 'string');
        $topic->body = clean($topic->body, 'user_topic_body');
        // 生成摘要
        $topic->excerpt = makeExcerpt($topic->body);

        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if ( ! $topic->slug) {
//            $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
            // 推送任务到队列
            dispatch(new TranslateSlug($topic));
        }
    }
}