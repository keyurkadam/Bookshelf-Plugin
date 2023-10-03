<?php

namespace keyurkadam\crafttestplugin\variables;

use yii\base\BaseObject;
use keyurkadam\crafttestplugin\services\BookService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class BookshelfVariable extends BaseObject
{
    /**
     * Retrieve a list of all books.
     *
     * This method creates an instance of the BookService and uses it to fetch a list of all available books.
     * The retrieved list of books is then returned to the caller.
     *
     * @return array An array containing all available books.
     */
    public function getAllBooks()
    {
        $bookService = new BookService();

        $books = $bookService->getAllBooks();
        return $books;
    }
}
