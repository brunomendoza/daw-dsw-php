<?php
namespace dsw\dao;

use \PDO;
use \PDOException;
use \dsw\model\Country;

class CountryDAO {
    private string $dsn;
    private array $config;

    public function __construct() {
        $this->config = include(__DIR__ . '/../../config.php');
        $this->dsn = sprintf('mysql:host=%s;dbname=%s', $this->config['host'], $this->config['db']);
    }

    public function getById(int $id) {
        $query = 'SELECT * FROM country WHERE countryid = :id';
        $country = null;
        $row;

        try {
            $dbh = new PDO($this->dsn, $this->config['user'], $this->config['pass']);
            $sth = $dbh->prepare($query);
            $sth->bindParam(':id', $id);

            if ($sth->execute()) {
                $row = $sth->fetch();

                if ($row) {
                    $country = new Country($row['countryid'], $row['countryname']);
                }
            }
        } catch (\Throwable $th) {
            printf("Country: Exception catched: %s", $th->getMessage());
        }

        return $country;
    }

    public function getAll() {
        $query = 'SELECT * FROM country';
        $countries = array();

        try {
            $dbh = new PDO($this->dsn, $this->config['user'], $this->config['pass']);
            $sth = $dbh->query($query);

            if ($sth) {
                foreach ($sth->fetchAll() as $country) {
                    $countries[] = new Country($country["countryid"], $country["countryname"]);
                }
            }
        } catch (PDOException $e) {
            printf("Country: Exception catched: %s", $e.getMessage());
        }

        return $countries;
    }
}