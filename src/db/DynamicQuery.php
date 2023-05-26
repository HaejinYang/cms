<?php

class DynamicQuery
{
    private mysqli $connection;
    private string $table;
    private string $update_table_query;
    private string $set_clause_query;
    private string $where_clause_query;
    private array $set_clause_data;
    private array $where_clause_data;

    public function __construct($mysqli)
    {
        $this->connection = $mysqli;
        $this->clearProperties();;
    }

    public function clear(): void
    {
        $this->clearProperties();
    }

    private function clearProperties(): void
    {
        $this->set_clause_data = [];
        $this->where_clause_data = [];
        $this->update_table_query = "";
        $this->set_clause_query = "";
        $this->where_clause_query = "";
    }

    public function table($table): void
    {
        $this->table = $table;
    }

    public function update(): DynamicQuery
    {
        $this->update_table_query = "UPDATE {$this->table} ";

        return $this;
    }

    public function set($key, $val): DynamicQuery
    {
        $this->where_clause_query .= "{$key} = ?, ";
        $this->set_clause_data[] = $val;

        return $this;
    }

    public function setByArray($params): DynamicQuery
    {
        foreach ($params as $key => $val) {
            $this->where_clause_query .= "{$key} = ?, ";
            $this->set_clause_data[] = $val;
        }

        return $this;
    }

    public function where($key, $val): DynamicQuery
    {
        $this->where_clause_query .= "{$key} = ? ";
        $this->where_clause_data[] = $val;

        return $this;
    }

    public function whereByArray($params): DynamicQuery
    {
        foreach ($params as $key => $val) {
            $this->where_clause_data .= "{$key} = ?, ";
            $this->where_clause_data[] = $val;
        }

        return $this;
    }

    public function and(): DynamicQuery
    {
        $this->where_clause_query .= "and ";

        return $this;
    }

    public function or(): DynamicQuery
    {
        $this->where_clause_query .= "or ";

        return $this;
    }

    public function run(): DynamicQuery
    {
        $query = $this->getQuery();
        $stmt = $this->connection->prepare($query);
        $types = $this->createTypes($this->set_clause_data);
        $types .= $this->createTypes($this->where_clause_data);
        $stmt->bind_param($types, ...array_merge($this->set_clause_data, $this->where_clause_data));
        $stmt->exectue();
    }

    public function getQuery(): DynamicQuery
    {
        return $this->update_table_query . " SET " . $this->set_clause_query . " WHERE " . $this->where_clause_query;
    }

    private function createTypes($data): DynamicQuery
    {
        $types = "";
        foreach ($data as $val) {
            if (is_numeric($val)) {
                $types .= "i";
            } else if (is_string($val)) {
                $types .= "s";
            } else if (is_float($val)) {
                $types .= "d";
            } else {
                $types .= "b";
            }
        }

        return $types;
    }
}