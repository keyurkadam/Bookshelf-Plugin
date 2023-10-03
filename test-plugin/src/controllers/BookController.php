<?php
namespace keyurkadam\crafttestplugin\controllers;

use Craft;
use keyurkadam\crafttestplugin\models\Book;
use craft\web\Controller;
use craft\web\UploadedFile;
use craft\web\Response;
use yii\web\NotFoundHttpException;
use keyurkadam\crafttestplugin\services\BookService;
use craft\elements\Entry;
use craft\base\Element;
use yii\db\ActiveRecord;
use craft\helpers\UrlHelper;




class BookController extends Controller
{
    private $bookService;

    
    /**
     * Action method for rendering the index page of the bookshelf in the custom plugin.
     * This method retrieves all books using the BookService and renders the index template.
     *
     * @return mixed The rendered template with a list of books.
     */
    public function actionIndex()
    {
        $bookService = new BookService();

        $books = $bookService->getAllBooks();
        return $this->renderTemplate('_test-plugin/bookshelf/index', ['books' => $books]);
        
    }

    /**
     * Retrieves all books from the book database using the BookService.
     *
     * This method is responsible for fetching a list of all available books.
     *
     * @return array An array of book data, typically including details such as title, author, genre, and more.
     */
    public function getAllBooks()
    {
        $bookService = new BookService();

        $books = $bookService->getAllBooks();
        return $books;
    }


    /**
     * Action method for adding a book through a front-end web form.
     *
     * This method handles the addition of a book using a web form submission.
     * It initializes a new Book model and interacts with the BookService to create the book.
     * If the form is submitted via POST, it processes the form data, validates it, and adds the book.
     * It also handles error cases and displays appropriate messages to the user.
     *
     * @return mixed Returns a redirect or an error message based on the success of the book addition.
     */
    public function actionWebadd()
    {
        
        $book = new Book();
        $bookService = new BookService();
        $redirectUrl = UrlHelper::siteUrl('add-book');
        
        if (Craft::$app->getRequest()->isPost) {
            $data = Craft::$app->getRequest()->getBodyParams();
            $coverImage = UploadedFile::getInstanceByName('coverImage');
            
            $book->storeData($data);
            if($book->load(Craft::$app->getRequest()->getBodyParams()))
            {
                $error = $book->getErrors();
                print_r($error);
            }
                
            if ($bookService->createBook($book,$coverImage)) {
                Craft::$app->getSession()->setNotice('Book added successfully.');
                return $this->redirect($redirectUrl);
            } else {
                Craft::$app->getSession()->setError('Failed to add the book.');
            }
        }
        
        return false;
    }
    
    /**
     * Action method for adding a book through a web form.
     *
     * This method handles the addition of a book using a web form submission.
     * It initializes a new Book model and interacts with the BookService to create the book.
     * If the form is submitted via POST, it processes the form data, validates it, and adds the book.
     * It also handles error cases and displays appropriate messages to the user.
     *
     * @return mixed Returns a redirect or an error message based on the success of the book addition.
     */
    public function actionAdd()
    {
        $book = new Book();
        $bookService = new BookService();
        
        
        if (Craft::$app->getRequest()->isPost) {
            $data = Craft::$app->getRequest()->getBodyParams();
            $coverImage = UploadedFile::getInstanceByName('coverImage');

           
            
            $book->storeData($data);
            if($book->load(Craft::$app->getRequest()->getBodyParams()))
            {
                $error = $book->getErrors();
                print_r($error);
            }
                
            if ($bookService->createBook($book,$coverImage)) {
                Craft::$app->getSession()->setNotice('Book added successfully.');
                return $this->redirect('bookshelf');
            } else {
                Craft::$app->getSession()->setError('Failed to add the book.');
            }
        }
        
        return $this->renderTemplate('_test-plugin/bookshelf/add', ['book' => $book]);
    }

    /**
     * Action method for editing a book through a web form.
     *
     * This method handles the editing of a book using a web form submission.
     * It interacts with the BookService to find and update the book based on the provided ID.
     * If the form is submitted via POST, it processes the form data, validates it, and updates the book.
     * It also handles error cases, such as book not found or validation failures, and displays appropriate messages to the user.
     *
     * @param int|null $id The ID of the book to edit (optional).
     * @return mixed Returns a redirect or a rendered template based on the success of the book update.
     * @throws NotFoundHttpException When the specified book ID is not found.
     */
    public function actionEdit(int $id = null)
    {
        $bookService = new BookService();
        if(!Craft::$app->getRequest()->isPost){
            
            $book = $bookService->findOneById($id);
            
            if (!$book) {
                throw new NotFoundHttpException('Book not found');
            }
        }
        

        if (Craft::$app->getRequest()->isPost) {
            
            $book = new Book();
            $data = Craft::$app->getRequest()->getBodyParams();
            $coverImage = UploadedFile::getInstanceByName('coverImage');
            
            $book->storeData($data);

            if ($book->validate() && $bookService->updateBook($book,$coverImage)) {
                Craft::$app->getSession()->setNotice('Book updated successfully.');
                return $this->redirect('bookshelf');
            } else {
                Craft::$app->getSession()->setError('Failed to update the book.');
            }
        }

        return $this->renderTemplate('_test-plugin/bookshelf/edit', ['book' => $book]);
    }

    /**
     * Action method for deleting a book.
     *
     * This method handles the deletion of a book based on the provided book ID.
     * It interacts with the BookService to find and delete the book.
     * It also handles error cases, such as book not found or deletion failures, and displays appropriate messages to the user.
     *
     * @param int|null $id The ID of the book to delete (optional).
     * @return mixed Returns a redirect to the bookshelf page with a success or error message.
     * @throws NotFoundHttpException When the specified book ID is not found.
     */

    public function actionDelete(int $id = null)
    {
        
        $bookService = new BookService();
        $book = $bookService->findOneById($id);

        if (!$book) {
            throw new NotFoundHttpException('Book not found');
        }

        if ($bookService->deleteBook($id)) {
            Craft::$app->getSession()->setNotice('Book deleted successfully.');
        } else {
            Craft::$app->getSession()->setError('Failed to delete the book.');
        }

        return $this->redirect('bookshelf');
    }
}
