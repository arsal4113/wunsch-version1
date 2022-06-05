<?php
use Migrations\AbstractMigration;

class UpdateProductVisit2 extends AbstractMigration
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
        $table = $this->table('product_visits');
        if ($table->hasIndex(['group'])) {
            $table
                ->removeIndex(['group'])
                ->update();
        }
        $this->table('product_visits')
            ->renameColumn('group', 'user_group')
            ->addIndex(['user_group'])
            ->update();
    }
}
