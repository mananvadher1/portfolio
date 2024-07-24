<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%testimonial}}`.
 */
class m240624_105407_add_rating_column_to_testimonial_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('testimonial', 'rating', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('testimonial', 'rating');
    }
}
