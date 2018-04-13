<?php
require __DIR__ . '/../../vendor/autoload.php';

use \Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Database\Schema\Blueprint;
use App\Models\SectionBooks;
use App\Models\Book;

// подключаем настройки базы данных
$config = include(__DIR__ . DIRECTORY_SEPARATOR . 'config.php');
$dbConfig = (object)$config["db"];
//Соединение с базой данный
$capsule = new Capsule;
$capsule->addConnection([
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
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();
Capsule::schema()->dropIfExists('section_books');

Capsule::schema()->create('section_books', function (Blueprint $table) {
    $table->increments('id');
    $table->string('section_name', 255);
    $table->timestamp('created_at');
    $table->timestamp('updated_at');
});
Capsule::schema()->dropIfExists('books');
Capsule::schema()->create('books', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('section_id');
    $table->string('book_name', 255);
    $table->string('author', 255);
    $table->integer('price');
    $table->timestamp('created_at');
    $table->timestamp('updated_at');
});
//заполняем тестовыми данными таблмцу с книжными секциями
for ($i = 0; $i < 5; $i++) {
    $faker = Faker\Factory::create();
    $sectionBooks = new SectionBooks();
    $sectionBooks->section_name = $faker->text(random_int(10, 100));
    $sectionBooks->save();
}
//создаем тестовые данные для таблицы с книгами.
for ($i = 0; $i < 20; $i++) {
    $faker = Faker\Factory::create();
    $book = new Book();
    $book->section_id = random_int(1, 5);
    $book->book_name = $faker->text(random_int(10, 150));
    $book->author = $faker->name;
    $book->price = random_int(100, 2000);
    $book->save();
}