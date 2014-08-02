<?php

namespace TomPHP\SpecificationExample\SQLiteRepository;

use PDO;
use TomPHP\SpecificationExample\Entity\Video;
use TomPHP\SpecificationExample\Repository\VideoRepository;
use TomPHP\SpecificationExample\Specification\Specification;
use TomPHP\SpecificationExample\Value\Date;
use TomPHP\SpecificationExample\Value\Price;

final class SQLiteVideoRepository implements VideoRepository
{
    /** @var PDO */
    private $db;

    public function __construct()
    {
        $this->db = new PDO('sqlite::memory:');

        $this->db->exec('CREATE TABLE IF NOT EXISTS videos (
                         id INTEGER PRIMARY KEY AUTOINCREMENT,
                         title TEXT,
                         releaseDate TEXT,
                         price INTEGER)');
    }

    public function clear()
    {
        $this->db->exec('DELETE FROM videos');
    }

    public function save(Video $video)
    {
        $statement = $this->db->prepare('INSERT INTO videos (title, releaseDate, price)
                                         VALUES (:title, :releaseDate, :price)');

        $statement->bindValue(':title', $video->getTitle());
        $statement->bindValue(':releaseDate', (string) $video->getReleaseDate());
        $statement->bindValue(':price', $video->getPrice()->getValue());

        $statement->execute();
    }

    public function fetchAll()
    {
        $result = $this->db->query('SELECT * FROM videos');

        $videos = [];
        foreach ($result as $row) {
            $videos[] = $this->createVideo($row);
        }

        return $videos;
    }

    public function fetchBySpecifcation(Specification $specification)
    {
        $whereClause = $specification->accept(new SQLiteSpecificationVisitor($this->db));

        $result = $this->db->query('SELECT * FROM videos WHERE ' . $whereClause);

        $videos = [];
        foreach ($result as $row) {
            $videos[] = $this->createVideo($row);
        }

        return $videos;
    }

    /** @return Video */
    private function createVideo(array $row)
    {
        return new Video(
            $row['title'],
            Date::fromDate($row['releaseDate']),
            new Price($row['price'])
        );
    }
}