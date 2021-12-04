<?php
namespace dsw\dao;

use \PDO;
use \PDOException;
use \dsw\model\Province;

class ProvinceDAO {
    private string $dsn;
    private array $config;

    public function __construct() {
        $this->config = include(__DIR__ . '/../../config.php');
        $this->dsn = sprintf('mysql:host=%s;dbname=%s', $this->config['host'], $this->config['db']);
    }

    public function getById(int $id) {
        $query = 'SELECT * FROM province WHERE provinceid = :id';
        $province = null;
        $row;

        try {
            $dbh = new PDO($this->dsn, $this->config['user'], $this->config['pass']);
            $sth = $dbh->prepare($query);
            $sth->bindParam(':id', $id);

            if ($sth->execute()) {
                $row = $sth->fetch();

                if ($row) {
                    $province = new Province($row['provinceid'], $row['provincename']);
                }
            }
        } catch (PDOException $e) {
            printf("Province: Exception catched: %s", $e->getMessage());
        }

        return $province;
    }
}