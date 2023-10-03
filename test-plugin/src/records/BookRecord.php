<?php

namespace keyurkadam\crafttestplugin\records;

use craft\db\ActiveRecord;
use craft\records\Element;

class BookRecord extends ActiveRecord{

    /**
     * Define the database table name associated with the BookRecord model.
     *
     * This static method specifies the database table name used for the BookRecord model.
     * It returns the table name as a string, allowing Craft CMS to associate the model
     * with the appropriate database table when performing database operations.
     *
     * @return string The database table name for the BookRecord model.
     */
    public static function tableName()
    {
        return '{{%bookshelf_books}}';
    }
}
?>