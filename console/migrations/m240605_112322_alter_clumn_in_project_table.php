<?php

use yii\db\Migration;

/**
 * Class m240605_112322_alter_clumn_in_project_table
 */
class m240605_112322_alter_clumn_in_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('project', 'start_date', 'date');
        $this->alterColumn('project', 'end_date', 'date');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240605_112322_alter_clumn_in_project_table cannot be reverted.\n";
        $this->alterColumn('project', 'start_date', 'integer');
        $this->alterColumn('project', 'end_date', 'integer');
        return false;
    }

}
