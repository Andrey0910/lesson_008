<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;

class BooksModel
{
    protected $capsule;

    public function __construct()
    {
        // подключаем настройки базы данных
        $config = include(__DIR__ . DIRECTORY_SEPARATOR . 'config.php');
        $dbConfig = (object)$config["db"];
        //Соединение с базой данный
        $this->capsule = new Capsule;
        $this->capsule->addConnection([
            'driver' => 'mysql',
            'host' => $dbConfig->host,
            'database' => $dbConfig->dbname,
            'username' => $dbConfig->username,
            'password' => $dbConfig->password,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        // Make this Capsule instance available globally via static methods... (optional)
        $this->capsule->setAsGlobal();
        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $this->capsule->bootEloquent();
    }

    public function getAll()
    {
        $book = Book::all();
        return $book;
    }

    public function getBook($id)
    {
        $book = Book::find($id);
        return $book;
    }

    public function update($id, $data){
        $book = Book::find($id);
        $book->section_id = $data['sectionId'];
        $book->book_name = $data['bookName'];
        $book->author = $data['author'];
        $book->price = $data['price'];
        $book->save();
        return 'Обновленик успешно.';
    }

    public function delete($id){
        Book::destroy($id);
        return 'Объект удален';
    }

    public function add($data){
        $book = new Book();
        $book->section_id = $data['sectionId'];
        $book->book_name = $data['bookName'];
        $book->author = $data['author'];
        $book->price = $data['price'];
        $book->save();
        return 'Объекь создан.';
    }
}