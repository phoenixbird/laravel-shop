<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //通过factory方法生成100个用户并保存到数据库中
        factory(User::class,100)->create();
    }
}
