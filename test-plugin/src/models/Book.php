<?php
namespace keyurkadam\crafttestplugin\models;

use craft\base\Model;
use craft\elements\Entry;
use craft\base\Element;


class Book extends Model
{
    public $id;
    public $title;
    public $author;
    public $genre;
    public $publicationYear;
    public $coverImage;
    public $description;

    /**
     * Populate model attributes with data from an associative array.
     *
     * This method takes an associative array of data, typically from a form submission,
     * and populates the attributes of the current model with the corresponding values.
     * It iterates through the array, checks if each attribute exists in the model,
     * and assigns the provided value to the model's attribute if it exists.
     *
     * @param array $data The associative array containing attribute-value pairs.
     * @return bool Always returns true, indicating successful attribute population.
     */

    public function storeData($data): bool
    {
        foreach($data as $attribute => $value)
        {
            if(property_exists($this,$attribute))
            {
                $this->$attribute = $value;
            }
        }

        return true;
    }

    
}
