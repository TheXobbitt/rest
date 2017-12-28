<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 12:17
 */

namespace rest\sqlite;

use SQLite3;

class Connection
{
    /**
     * @var SQLite3
     */
    private $pdo;

    public function __construct()
    {
        $this->open();
    }

    public function open()
    {
        if (!is_null($this->pdo)) {
            return;
        }

        $this->pdo = new SQLite3('data/pdffiller.db');
    }

    public function close()
    {
        $this->pdo->close();
        $this->pdo = null;
    }

    /**
     * @return SQLite3
     */
    public function getPdo(): SQLite3
    {
        return $this->pdo;
    }
}
