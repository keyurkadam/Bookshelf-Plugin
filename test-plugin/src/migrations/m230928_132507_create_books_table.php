<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;

/**
 * m230928_132507_create_books_table migration.
 */
class m230928_132507_create_books_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%bookshelf_books}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'author' => $this->string()->notNull(),
            'genre' => $this->string()->notNull(),
            'publicationYear' => $this->string(),
            'coverImage' => $this->string(),
            'description' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%bookshelf_books}}');
    }
}
