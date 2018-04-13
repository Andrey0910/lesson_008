<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;

class SectionBooksModel
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
        $sectionBooks = SectionBooks::all();
        return $sectionBooks;
    }

    public function getBook($id)
    {
        $sectionBooks = SectionBooks::find($id);
        return $sectionBooks;
    }

    public function update($id, $sectionName){
        $sectionBooks = SectionBooks::find($id);
        $sectionBooks->section_name = $sectionName;
        $sectionBooks->save();
        return 'Обновленик успешно.';
    }

    public function delete($id){
        SectionBooks::destroy($id);
        return 'Объект удален';
    }

    public function add($sectionName){
        $sectionBooks = new SectionBooks();
        $sectionBooks->section_name = $sectionName;
        $sectionBooks->save();
        return 'Объекь создан.';
    }
}