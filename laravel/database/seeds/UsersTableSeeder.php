<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 20)->create();
        //修改数据库ID为1的数据
        $user = \App\User::find(1);
        $user->name = '李彬';
        $user->email = '492316920@qq.com';
        $user->password = bcrypt('260078');
        $user->is_admin = true;
        $user->save();
    }
}
