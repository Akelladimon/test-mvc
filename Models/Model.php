<?php

namespace Models;

use PDO;
use PDOException;

class Model
{
    public const TABLE_NAME = 'user_form';
    public string $table;
    private PDO $connection;

    public function __construct()
    {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;

            $this->connection = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
            // Do something with the $pdo object, such as querying the database
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $this->table = static::TABLE_NAME;
    }


    /**
     * @param array $data
     * @return bool|string|null
     */
    public function store(array $data): bool|string|null
    {
        try {
            $fields = implode(', ', array_keys($data));

            $placeholders = ':' . implode(', :', array_keys($data));
            $sql = "INSERT INTO $this->table ($fields) VALUES ($placeholders)";
            $stmt = $this->connection->prepare($sql);

            foreach ($data as $field => $value) {
                $stmt->bindValue(":$field", $value);
            }

            $stmt->execute();

            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            // Handle any errors that occurred during the process
            echo "Error: " . $e->getMessage();

            return  false;
        }
    }

    /**
     * @param array $data
     * @param int $id
     * @return int|string
     */
    protected function update( array $data, int $id): int|string
    {
        try {
            $updateFields = "";
            foreach ($data as $field => $value) {
                $updateFields .= "$field = :$field, ";
            }
            $updateFields = rtrim($updateFields, ', ');

            $sql = "UPDATE $this->table SET $updateFields WHERE $id";

            // Prepare the SQL query
            $stmt = $this->connection->prepare($sql);

            // Bind the values from the $data array to the update placeholders
            foreach ($data as $field => $value) {
                $stmt->bindValue(":$field", $value);
            }

            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();

            return  false;
        }
    }

    /**
     * @param string $field
     * @param string $value
     * @return array|bool
     */
    public function getWhereField(string $field, string $value):array|bool
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE $field = :need_value");
            $stmt->bindParam(':need_value', $value);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();

            return  false;
        }
    }
}