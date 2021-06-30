<?php


use IESLaCierva\Domain\User\ValueObject\Role;
use Phinx\Seed\AbstractSeed;

class UserSeeds extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create('es_ES');
        $data = [];
        for ($i=0; $i < 10;$i++) {
            $email = $faker->email;
            $data[] =
                [
                    'id' => uniqid(),
                    'name' => $faker->name,
                    'email' => $email,
                    'password' => password_hash($email, PASSWORD_DEFAULT),
                    'role' => $faker->randomElement([Role::ADMIN, Role::EDITOR]),
                ];
        }

        $this->table('user')->insert($data)->saveData();
    }
}
