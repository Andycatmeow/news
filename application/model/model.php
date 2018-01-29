<?php

class Model {
    /**
     * @param object $db
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getAllNews() {
        $sql = "SELECT * FROM news ORDER BY date DESC;";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAmountOfNews() {
        $sql = "SELECT COUNT(id) AS amount_of_news FROM news";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()->amount_of_news;
    }

    public function addNews($title, $entry) {
        $date = date("Y-m-d H:i:s");
        $sql = "
        INSERT INTO `news` (
            `title`,
            `entry`,
            `date`
        ) VALUES (
            :title,
            :entry,
            :date
        );";
        $query = $this->db->prepare($sql);
        
        $parameters = array(
            ':title' => $title,
            ':entry' => $entry,
            ':date' => $date
        );

        $query->execute($parameters);
        $last_id = $this->db->lastInsertId();

        return $last_id;
    }

    public function viewNews($news_id) {
        $sql = "SELECT * FROM news WHERE id = :news_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':news_id' => $news_id);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function deleteNews($news_id) {
        $sql = "DELETE FROM news WHERE id = :news_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':news_id' => $news_id);

        $query->execute($parameters);
    }
}