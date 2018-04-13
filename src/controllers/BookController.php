<?php

namespace App\Controllers;

use App\Models\BooksModel;

class BookController extends MainController
{
    protected $nameView = 'BooksView';
    public function update()
    {
        $booksModel = new BooksModel();
        $id = $_REQUEST['id'];
        $book = [
            'sectionId' => empty($_REQUEST['section_id']) ? 1 : $_REQUEST['section_id'],
            'bookName' => $_REQUEST['book_name'],
            'author' => $_REQUEST['author'],
            'price' => $_REQUEST['price']
        ];
        $data['update'] = $booksModel->update($id, $book);
        $this->view->render($this->nameView, $data);
    }

    public function delete()
    {
        $booksModel = new BooksModel();
        $id = $_REQUEST['id'];
        $data['delete'] = $booksModel->delete($id);
        $this->view->render($this->nameView, $data);
    }

    public function add()
    {
        $booksModel = new BooksModel();
        $book = [
            'sectionId' => empty($_REQUEST['section_id']) ? 1 : $_REQUEST['section_id'],
            'bookName' => $_REQUEST['book_name'],
            'author' => $_REQUEST['author'],
            'price' => $_REQUEST['price']
        ];
        $data['add'] = $booksModel->add($book);
        $this->view->render($this->nameView, $data);

    }

    public function index()
    {
        //$data['method'] = __METHOD__;
        $booksModel = new BooksModel();
        $id = $_REQUEST['id'];
        if (!empty($id)) {
            $data['books'] = $booksModel->getBook($id);
            $this->view->render($this->nameView, $data);
            exit();
        }
        $data['books'] = $booksModel->getAll();
        $this->view->render($this->nameView, $data);
    }
}