<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserFile;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $defaultUsers = [
            [
                'name' => 'Lucas', 
                'lastName' => 'De Luca',
                'files' => [
                    [
                        'file_name' => 'test1.jpg',
                        'url' => '/storage/app/public/12345.jpg',
                        'created_at' => Carbon::createFromFormat('Y-m-d', '2020-05-01'),
                        'updated_at' => $now
                    ],
                    [
                        'file_name' => 'test2.jpg',
                        'url' => '/storage/app/public/5678.jpg',
                        'created_at' => Carbon::createFromFormat('Y-m-d', '2020-04-01'),
                        'updated_at' => $now,
                    ],
                    [
                        'file_name' => 'test1.jpg',
                        'url' => '/storage/app/public/12345.jpg',
                        'created_at' => Carbon::createFromFormat('Y-m-d', '2020-06-01'),
                        'updated_at' => $now,
                        'deleted_at' => Carbon::createFromFormat('Y-m-d', '2020-06-10')
                    ],
                ]
            ],
            [
                'name' => 'Guillermet', 
                'lastName' => 'gaston', 
                'softDelete' => true,
                'files' => [
                    [
                        'file_name' => 'test1.jpg',
                        'url' => '/storage/app/public/12345.jpg',
                        'created_at' => Carbon::createFromFormat('Y-m-d', '2020-06-01'),
                        'updated_at' => $now,
                        'deleted_at' => Carbon::createFromFormat('Y-m-d', '2020-06-10')
                    ],
                    [
                        'file_name' => 'test1.jpg',
                        'url' => '/storage/app/public/12345.jpg',
                        'created_at' => Carbon::createFromFormat('Y-m-d', '2020-07-01'),
                        'updated_at' => $now,
                        'deleted_at' => Carbon::createFromFormat('Y-m-d', '2020-06-10')
                    ],
                    [
                        'file_name' => 'test1.jpg',
                        'url' => '/storage/app/public/12345.jpg',
                        'created_at' => Carbon::createFromFormat('Y-m-d', '2020-08-01'),
                        'updated_at' => $now,
                    ],
                ]
            ],
            [
                'name' => 'Manzanares', 
                'lastName' => 'Andres',
                'files' => [
                    [
                        'file_name' => 'test1.jpg',
                        'url' => '/storage/app/public/12345.jpg',
                        'created_at' => Carbon::createFromFormat('Y-m-d', '2020-08-01'),
                        'updated_at' => $now,
                    ],
                ]
            ],
        ];

        foreach($defaultUsers as $defaultUser){
            $user = new User;
            $user->name = $defaultUser['name'];
            $user->last_name = $defaultUser['lastName'];
            $user->save();

            if(array_key_exists('softDelete', $defaultUser) && true === $defaultUser['softDelete']){
                $user->delete();
            }

            if(array_key_exists('files', $defaultUser)){
                $user->files()->createMany($defaultUser['files']);
            }
        }
    }
}
