<?php
use Migrations\AbstractMigration;

class EbaySiteCodeToken extends AbstractMigration
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

        $this->table('ebay_sites')
            ->addColumn('ebay_site_code_type', 'string', [
                'after' => 'ebay_global_id',
                'limit' => 256,
                'null' => false
            ])->update();

        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Australia' WHERE  ebay_site_id = 15;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Austria' WHERE  ebay_site_id = 16;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Belgium_Dutch' WHERE  ebay_site_id = 123;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Belgium_French' WHERE  ebay_site_id = 23;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Canada' WHERE  ebay_site_id = 2;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'CanadaFrench' WHERE  ebay_site_id = 210;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'France' WHERE  ebay_site_id = 71;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Germany' WHERE  ebay_site_id = 77;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'HongKong' WHERE  ebay_site_id = 201;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'India' WHERE  ebay_site_id = 203;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Ireland' WHERE  ebay_site_id = 205;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Italy' WHERE  ebay_site_id = 101;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Malaysia' WHERE  ebay_site_id = 207;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Netherlands' WHERE  ebay_site_id = 146;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Philippines' WHERE  ebay_site_id = 211;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Poland' WHERE  ebay_site_id = 212;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Russia' WHERE  ebay_site_id = 215;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Singapore' WHERE  ebay_site_id = 216;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Spain' WHERE  ebay_site_id = 186;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'Switzerland' WHERE  ebay_site_id = 193;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'UK' WHERE  ebay_site_id = 3;");
        $this->execute("UPDATE  ebay_sites SET  ebay_site_code_type =  'US' WHERE  ebay_site_id = 0;");
    }
}
