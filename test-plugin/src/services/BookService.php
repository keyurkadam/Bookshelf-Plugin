<?php

namespace keyurkadam\crafttestplugin\services;

use Craft;
use keyurkadam\crafttestplugin\models\Book;
use keyurkadam\crafttestplugin\records\BookRecord;
use yii\base\Component;


use craft\elements\Asset;
use craft\helpers\Assets;
use craft\helpers\StringHelper;
use craft\web\UploadedFile;
use craft\errors\UploadFailedException;

class BookService extends Component
{
    /**
     * Retrieve all books from the database.
     *
     * This method fetches all book records from the database using BookRecord.
     * It then maps each record to a Book model, populates the model's attributes,
     * and adds it to an array of books. The resulting array contains all available books.
     *
     * @return array An array of Book models representing all books in the database.
     */
    public function getAllBooks()
    {
        $bookRecords = BookRecord::find()->all();
        $books = [];

        foreach ($bookRecords as $bookRecord)
        {
            $book = new Book();
            $book->setAttributes($bookRecord->attributes, false);
            $books[] = $book;
        }
        return $books;
    }

    /**
     * Find a book record by its ID.
     *
     * This method attempts to find a book record in the database using the provided ID.
     * It utilizes the `BookRecord::findOne()` method to retrieve a single book record.
     * If a book record is found, it is returned; otherwise, it returns null.
     *
     * @param int $id The ID of the book record to find.
     * @return BookRecord|null The found book record or null if not found.
     */

    public static function findOneById(int $id)
    {
        $book = BookRecord::findOne($id);
        if ($book) {
            
            return $book;
        }

        return null;
    }

    /**
     * Create a new book record in the database.
     *
     * This method takes a Book model and an UploadedFile for the book's cover image.
     * It creates a new BookRecord instance, populates its attributes with data from the Book model,
     * and attempts to save the record to the database.
     *
     * @param Book $book The Book model containing book data.
     * @param UploadedFile $coverImage The uploaded cover image for the book.
     * @return bool True if the book record is successfully saved, otherwise false.
     */
    public function createBook(Book $book,UploadedFile $coverImage): bool{

        // having a issue in uploading the asset
        // if($coverImage)
        // {
        //     $asset = $this->uploadCoverImage($coverImage);

        // }

        if (Craft::$app->getElements()->saveElement($asset)) {
            $assetId = $asset->id;
        } else {
            $errors = $asset->getErrors();
        }


        $record = new BookRecord();
        $record->title = $book->title;
        $record->author = $book->author;
        $record->genre = $book->genre;
        $record->publicationYear = $book->publicationYear;
        $record->coverImage = $book->coverImage;
        $record->description = $book->description;
        
        return $record->save();

    }

    /**
     * Update an existing book record in the database.
     *
     * This method takes a Book model and an UploadedFile for the book's cover image.
     * It attempts to find the book record in the database by its ID and updates its attributes
     * with data from the provided Book model. The record is then saved to the database.
     *
     * @param Book $book The Book model containing updated book data.
     * @param UploadedFile $coverImage The updated cover image for the book.
     * @return bool True if the book record is successfully updated, otherwise false.
     */

    public function updateBook(Book $book,UploadedFile $coverImage): bool{

        // if($coverImage)
        // {
        //     $asset = $this->uploadCoverImage($coverImage);

        // }

        
        $record = BookRecord::findOne($book->id);

        if(!$record)
        {
            return false;
        }
        
        $record->title = $book->title;
        $record->author = $book->author;
        $record->genre = $book->genre;
        $record->publicationYear = $book->publicationYear;
        $record->coverImage = $book->coverImage;
        $record->description = $book->description;
        
        return $record->save();

    }
    /**
     * Delete an existing book record from the database.
     *
     * This method takes the ID of the book to be deleted and attempts to find the book record
     * in the database. If the record is found, it is deleted from the database, and the method
     * returns true to indicate a successful deletion. If the record is not found, it returns false.
     *
     * @param int $id The ID of the book record to delete.
     * @return bool True if the book record is successfully deleted, otherwise false.
     */
    public function deleteBook(int $id): bool{
        
        $record = BookRecord::findOne($id);

        if(!$record)
        {
            return false;
        }
        
        return $record->delete();

    }
    /**
     * Upload a cover image file and create an Asset element.
     *
     * This method takes an UploadedFile representing a cover image and uploads it to the specified folder.
     * It creates an Asset element and assigns the uploaded file to it, then saves the element in Craft CMS.
     *
     * @param UploadedFile $file The UploadedFile representing the cover image.
     * @return Asset|null The created Asset element if successful, otherwise null.
     */
    public function uploadCoverImage(UploadedFile $file)
    {
        $folderId = 4;

        

        $asset = new Asset();

        $asset->tempFilePath = $file->tempName;
        $asset->filename = $file->name;
        $asset->newFolderId = $folderId;
    
        $result = Craft::$app->getElements()->saveElement($asset);

        if($result)
        {
            return $asset;
        }
        return null;
    }
}


?>