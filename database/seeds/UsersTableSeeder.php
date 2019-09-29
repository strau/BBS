<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1569757137349&di=67f94828a67e5cb48eb15bec7d4715cc&imgtype=0&src=http%3A%2F%2Fhbimg.b0.upaiyun.com%2Fdc810f624ec50dfa211d30b40f00aed0af04691ab636-YSbVzD_fw658',
            'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1569757164942&di=c5208794d57ca5d904b3b32e445a88ae&imgtype=0&src=http%3A%2F%2Fb-ssl.duitang.com%2Fuploads%2Fitem%2F201806%2F29%2F20180629003801_jvMPt.jpeg',
            'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1569757164942&di=9c4acc3602512aa103cd2710b0b4ddf0&imgtype=0&src=http%3A%2F%2Fb-ssl.duitang.com%2Fuploads%2Fitem%2F201703%2F09%2F20170309235813_EsVu3.jpeg',
            'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1569757164941&di=b3a8fa76e13f8e860f21fe19a0d2b6e5&imgtype=0&src=http%3A%2F%2Fb-ssl.duitang.com%2Fuploads%2Fitem%2F201706%2F16%2F20170616141904_dzQhu.jpeg',
            'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1569757164929&di=01ad77e2a6231441a12c5c5025746608&imgtype=0&src=http%3A%2F%2Fb-ssl.duitang.com%2Fuploads%2Fitem%2F201604%2F09%2F20160409200835_PF3U5.jpeg',
            'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1569757164900&di=4ec575b234a63643182ea57bb102ad1e&imgtype=0&src=http%3A%2F%2Fpic3.zhimg.com%2F50%2Fv2-3e27ed8bba5e04c41a5f30cd19cdbdad_hd.jpg',
            'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1569757164897&di=4493fd1cf32295165e6434fe175f74e0&imgtype=0&src=http%3A%2F%2Fcdn.duitang.com%2Fuploads%2Fblog%2F201307%2F01%2F20130701014340_yLG5H.jpeg',
        ];

        // 生成数据集合
        $users = factory(User::class)
            ->times(10)
            ->make()
            ->each(function ($user, $index)
            use ($faker, $avatars)
            {
                // 从头像数组中随机取出一个并赋值
                $user->avatar = $faker->randomElement($avatars);
            });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'sunny';
        $user->email = 'sunny@qq.com';
        $user->avatar = 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1569757137349&di=67f94828a67e5cb48eb15bec7d4715cc&imgtype=0&src=http%3A%2F%2Fhbimg.b0.upaiyun.com%2Fdc810f624ec50dfa211d30b40f00aed0af04691ab636-YSbVzD_fw658';
        $user->save();

        // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('Founder');

        // 将 2 号用户指派为『管理员』
        $user = User::find(2);
        $user->assignRole('Maintainer');
    }
}
