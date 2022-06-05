<?php
use Migrations\AbstractMigration;

class Bugfixin extends AbstractMigration
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
        $this->table('core_sellers')
            ->changeColumn('created', 'datetime', ['null' => true, 'default' => null])
            ->changeColumn('modified', 'datetime', ['null' => true, 'default' => null])
            ->update();

        $this->table('core_users')
            ->changeColumn('created', 'datetime', ['null' => true, 'default' => null])
            ->changeColumn('modified', 'datetime', ['null' => true, 'default' => null])
            ->update();

        $this->table('core_user_roles')
            ->changeColumn('created', 'datetime', ['null' => true, 'default' => null])
            ->changeColumn('modified', 'datetime', ['null' => true, 'default' => null])
            ->update();

        $core_user_roles_core_users_table =$this->table('core_user_roles_core_users');
        $created_column = $core_user_roles_core_users_table->hasColumn('created');
        $modified_column = $core_user_roles_core_users_table->hasColumn('modified');

        if ($created_column)
        {
            $core_user_roles_core_users_table->removeColumn('created')
                ->update();
        }

        if ($modified_column)
        {
            $core_user_roles_core_users_table->removeColumn('modified')
                ->update();
        }


        $core_marketplaces_core_sellers_table = $this->table('core_marketplaces_core_sellers');
        $created_column = $core_marketplaces_core_sellers_table->hasColumn('created');
        $modified_column = $core_marketplaces_core_sellers_table->hasColumn('modified');
        if ($created_column)
        {
            $core_marketplaces_core_sellers_table->removeColumn('created')
                ->update();
        }

        if ($modified_column)
        {
            $core_marketplaces_core_sellers_table->removeColumn('modified')
                ->update();
        }

        $exists_ebay_fashion_table = $this->hasTable('core_sellers_ebay_fashion_templates');
        if ($exists_ebay_fashion_table) {
            $core_sellers_ebay_fashion_templates_table = $this->table('core_sellers_ebay_fashion_templates');
            $created_column = $core_sellers_ebay_fashion_templates_table->hasColumn('created');
            $modified_column = $core_sellers_ebay_fashion_templates_table->hasColumn('modified');
            if ($created_column)
            {
                $core_sellers_ebay_fashion_templates_table->removeColumn('created')
                    ->update();
            }

            if ($modified_column)
            {
                $core_sellers_ebay_fashion_templates_table->removeColumn('modified')
                    ->update();
            }
        }


    }
}
