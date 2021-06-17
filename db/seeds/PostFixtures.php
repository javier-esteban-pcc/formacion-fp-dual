<?php


use IESLaCierva\Domain\Post\ValueObject\Status;
use Phinx\Seed\AbstractSeed;

class PostFixtures extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'UserFixtures',
        ];
    }

    public function run()
    {
        $faker = Faker\Factory::create('es');
        $data = [];
        $userIds = $this->adapter->fetchAll('SELECT id FROM user');

        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'id' => uniqid(),
                'title' => $faker->realText(50),
                'body' => $faker->realText(300),
                'user_id' =>  $faker->randomElement(array_column($userIds, 'id')),
                'status' => $faker->randomElement([Status::PUBLISHED, Status::PENDING])
            ];

        }

        $this->table('post')->insert($data)->saveData();
    }
}
