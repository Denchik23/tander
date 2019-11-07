<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%authors}}`.
 */
class m191107_080037_create_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%authors}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20)->notNull(),
            'family' => $this->string(),
            'dob' => $this->datetime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%authors}}');
    }
}
