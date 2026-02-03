<?php

require_once 'INewsDB.class.php';

class NewsDB implements INewsDB
{
    const DB_NAME = 'news.db';

    private $_pdo;

    public function __construct()
    {
        if (file_exists(self::DB_NAME) && filesize(self::DB_NAME) > 0) {
            try {
                $this->_pdo = new PDO('sqlite:' . self::DB_NAME);
                $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Ошибка подключения к базе данных: " . htmlspecialchars($e->getMessage()));
            }
        } else {
            try {

                $this->_pdo = new PDO('sqlite:' . self::DB_NAME);
                $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $this->_pdo->beginTransaction();

                try {

                    $sql = file_get_contents('news.txt');
                    if ($sql === false) {
                        throw new Exception("Не удалось прочитать файл news.txt");
                    }

                    $this->_pdo->exec($sql);

                    $this->_pdo->commit();

                } catch (PDOException $e) {
                    if ($this->_pdo->inTransaction()) {
                        $this->_pdo->rollBack();
                    }
                    error_log("PDO исключение при подключении к новой БД: " . $e->getMessage());
                    error_log("PDO errorInfo: " . json_encode($this->_pdo->errorInfo()));
                    die("Невозможно создать базу данных: " . htmlspecialchars($e->getMessage()));
                }
                catch (Exception $e) {
                    if ($this->_pdo->inTransaction()) {
                        $this->_pdo->rollBack();
                    }
                    error_log("Ошибка: " . $e->getMessage());
                    error_log("ErrorInfo: " . json_encode($this->_pdo->errorInfo()));
                    die("Невозможно создать базу данных: " . htmlspecialchars($e->getMessage()));
                }

            } catch (PDOException $e) {
                error_log("PDO исключение при подключении к новой БД: " . $e->getMessage());
                error_log("PDO errorInfo: " . json_encode($this->_pdo->errorInfo()));
                die("Невозможно создать базу данных: " . htmlspecialchars($e->getMessage()));
            }
        }
    }


    public function __destruct()
    {
        $this->_pdo = null;
    }

    protected function getDb()
    {
        return $this->_pdo;
    }
    function saveNews($title, $category, $description, $source)
    {
        try {
            $dt = time();

            $title_q = $this->_pdo->quote($title);
            $category_q = (int) $category;
            $description_q = $this->_pdo->quote($description);
            $source_q = $this->_pdo->quote($source);
            $dt_q = (int) $dt;

            $sql = "INSERT INTO msgs (title, category, description, source, datetime) 
                    VALUES ($title_q, $category_q, $description_q, $source_q, $dt_q)";

            $result = $this->_pdo->exec($sql);

            return $result !== false;
        } catch (PDOException $e) {
            error_log("Ошибка при сохранении новости: " . $e->getMessage());
            error_log("PDO errorInfo: " . json_encode($this->_pdo->errorInfo()));
            return false;
        }

    }
    function getNews()
    {
        try {
            $sql = "
                SELECT msgs.id as id, title, category.name as category, description, source, datetime
                FROM msgs
                JOIN category ON category.id = msgs.category
                ORDER BY msgs.id DESC
            ";

            $stmt = $this->_pdo->query($sql);
            $news = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $news[] = $row;
            }

            return $news;
        } catch (PDOException $e) {
            error_log("Ошибка при получении новостей: " . $e->getMessage());
            error_log("PDO errorInfo: " . json_encode($this->_pdo->errorInfo()));
            return false;
        }
    }
    function deleteNews($id)
    {
        try {
            $id = (int) $id;

            $this->_pdo->exec("DELETE FROM msgs WHERE id = $id");

            $changes = $this->_pdo->query("SELECT changes()")->fetchColumn();

            return (int) $changes > 0;
        } catch (PDOException $e) {
            error_log("Ошибка при удалении новости: " . $e->getMessage());
            error_log("PDO errorInfo: " . json_encode($this->_pdo->errorInfo()));
            return false;
        }
    }

}

// $news = new NewsDB();

// $db = $news->getDb();
// $result = $db->query("SELECT name FROM sqlite_master WHERE type='table';");
// while ($row = $result->fetchArray()) {
//     echo "Таблица: " . $row['name'] . "<br>";
// }