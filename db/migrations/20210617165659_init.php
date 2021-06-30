<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Init extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up(): void
    {
        $this->execute("
            CREATE TABLE user 
            (
                    id char(13) not null,
                    name varchar(255) null,
                    email varchar(255) null,
                    password varchar(255) null,
                    role varchar(255) null,
                    constraint user_pk
                        primary key (id)
                );
        ");


    }

    public function down()
    {
        $this->execute("
            DROP TABLE user 
        ");
    }
}
