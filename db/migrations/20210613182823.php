<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class V20210613182823 extends AbstractMigration
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
    public function change(): void
    {
//        $this->execute('create schema posts;');

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

        $this->execute("
            create table post
                (
                    id char(13) not null,
                    title varchar(255) null,
                    body text null,
                    user_id char(13) null,
                    status varchar(255) null,
                    created_at datetime null
                );
        ");

        $this->execute("
            create table payment
                (
                    id char(13) not null,
                    user_id char(13) not null,
                    amount int,
                    date datetime,  
                    post_id char(13)
                )
        ");
    }
}
