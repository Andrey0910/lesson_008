<?php

namespace App\Controllers;

use App\Models\SectionBooksModel;

class SectionBooksController extends MainController
{
    protected $nameView = 'BooksView';
    public function update()
    {
        $sectionBooksModel = new SectionBooksModel();
        $id = $_REQUEST['id'];
        $sectionName = $_REQUEST['section_name'];
        $data['update'] = $sectionBooksModel->update($id, $sectionName);
        $this->view->render($this->nameView, $data);
    }
    public function delete()
    {
        $sectionBooksModel = new SectionBooksModel();
        $id = $_REQUEST['id'];
        $data['delete'] = $sectionBooksModel->delete($id);
        $this->view->render($this->nameView, $data);
    }
    public function add()
    {
        $sectionBooksModel = new SectionBooksModel();
        $sectionName = $_REQUEST['section_name'];
        $data['add'] = $sectionBooksModel->add($sectionName);
        $this->view->render($this->nameView, $data);

    }
    public function index()
    {
        $sectionBooksModel = new SectionBooksModel();
        $id = $_REQUEST['id'];
        if (!empty($id)) {
            $data['sectionBooks'] = $sectionBooksModel->getBook($id);
            $this->view->render($this->nameView, $data);
            exit();
        }
        $data['sectionBooks'] = $sectionBooksModel->getAll();
        $this->view->render($this->nameView, $data);
    }
}