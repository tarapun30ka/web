<?php

require_once 'INewsDB.class.php';

class NewsDB implements INewsDB, IteratorAggregate
{
    const DB_NAME = 'news.db';
    private array $items = [];
    private $_db;
    public function __construct()
    {

        if (!file_exists(self::DB_NAME)) {
            $this->_db = new SQLite3(self::DB_NAME);

            $sql = file_get_contents('news.txt');
            $this->_db->exec($sql);

        } else {
            $this->_db = new SQLite3(self::DB_NAME);
        }

        $this->getCategories();
    }
    public function __destruct()
    {
        if ($this->_db) {
            $this->_db->close();
        }
    }
    private function getCategories(): void
    {
        $db = new SQLite3(__DIR__ . '/news.db');
        $stmt = $db->prepare('SELECT id, name FROM category');
        $result = $stmt->execute();

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $this->items[(int)$row['id']] = $row['name'];
        }

        $db->close();
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    protected function getDb()
    {
        return $this->_db;
    }
    function saveNews($title, $category, $description, $source)
    {
        $dt = time();

        $stmt = $this->_db->prepare(
            "INSERT INTO msgs (title, category, description, source, datetime) VALUES (:title, :category, :description, :source, :datetime)"
        );
        $stmt->bindValue(':title', $title, SQLITE3_TEXT);
        $stmt->bindValue(':category', $category, SQLITE3_INTEGER);
        $stmt->bindValue(':description', $description, SQLITE3_TEXT);
        $stmt->bindValue(':source', $source, SQLITE3_TEXT);
        $stmt->bindValue(':datetime', $dt, SQLITE3_INTEGER);

        return $stmt->execute() !== false;

    }
    function getNews()
    {

        $sql = "
            SELECT msgs.id as id, title, category.name as category, description, source, datetime
            FROM msgs, category
            WHERE category.id = msgs.category
            ORDER BY msgs.id DESC
        ";

        $result = $this->_db->query($sql);
        if (!$result) {
            return false;
        }

        $news = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $news[] = $row;
        }

        return $news;


    }
    function deleteNews($id)
    {        
        $stmt = $this->_db->prepare("DELETE FROM msgs WHERE id = :id");
        if (!$stmt) {
            return false;
        }
        $stmt->bindValue(':id', (int)$id, SQLITE3_INTEGER);
        $result = $stmt->execute();

        return $result !== false && $this->_db->changes() > 0;
    }


}

// $news = new NewsDB();

// $db = $news->getDb();
// $result = $db->query("SELECT name FROM sqlite_master WHERE type='table';");
// while ($row = $result->fetchArray()) {
//     echo "Таблица: " . $row['name'] . "<br>";
// }