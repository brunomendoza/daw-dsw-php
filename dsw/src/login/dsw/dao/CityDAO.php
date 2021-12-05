<?php
namespace dsw\dao;

use \PDO;
use \PDOException;
use \dsw\model\City;

class CityDAO {
    private string $dsn;
    private array $config;

    public function __construct() {
        $this->config = include(__DIR__ . '/../../config.php');
        $this->dsn = sprintf('mysql:host=%s;dbname=%s', $this->config['host'], $this->config['db']);
    }

    public function getById(int $id) {
        $query = 'SELECT * FROM city WHERE cityid = :id';
        $city = null;
        $row;

        try {
            $dbh = new PDO($this->dsn, $this->config['user'], $this->config['pass']);
            $sth = $dbh->prepare($query);
            $sth->bindParam(':id', $id);

            if ($sth->execute()) {
                $row = $sth->fetch();

                if ($row) {
                    $city = new City($row['cityid'], $row['cityname']);
                }
            }
        } catch (\Throwable $th) {
            printf("City: Exception catched: %s", $th->getMessage());
        }

        return $city;
    }

    public function getAll() {
        $query = 'SELECT * FROM city';
        $cities = array();

        try {
            $dbh = new PDO($this->dsn, $this->config['user'], $this->config['pass']);
            $sth = $dbh->query($query);

            if ($sth) {
                foreach ($sth->fetchAll() as $city) {
                    $cities[] = new City($city["cityid"], $city["cityname"]);
                }
            }
        } catch (PDOException $e) {
            printf("City: Exception catched: %s", $e.getMessage());
        }

        return $cities;
    }
}