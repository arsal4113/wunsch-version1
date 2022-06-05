<?php
use Migrations\AbstractMigration;

class AlterFeederCategoriesforEmoji extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->execute('Alter Table feeder_categories CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
        $this->execute('ALTER TABLE feeder_categories modify name VARCHAR(50) charset utf8mb4');
    }
}
