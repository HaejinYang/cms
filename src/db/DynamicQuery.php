<?php

class DynamicQuery
{
    private mysqli $connection;
    private string $table;
    private string $update_query;
    private string $set_clause_query;
    private string $where_clause_query;
    private array $set_clause_data;
    private array $where_clause_data;

    public function __construct(&$mysqli)
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
        $this->table = "";
        $this->set_clause_data = [];
        $this->where_clause_data = [];
        $this->update_query = "";
        $this->set_clause_query = "";
        $this->where_clause_query = "";
    }

    public function table($table): DynamicQuery
    {
        $this->table = $table;

        return $this;
    }

    public function update(): DynamicQuery
    {
        $this->update_query = "UPDATE ";

        return $this;
    }

    public function set($key, $val): DynamicQuery
    {
        $this->set_clause_query .= " {$key} = ?, ";
        $this->set_clause_data[] = $val;

        return $this;
    }

    public function setByArray($params): DynamicQuery
    {
        foreach ($params as $key => $val) {
            $this->set_clause_query .= " {$key} = ?, ";
            $this->set_clause_data[] = $val;
        }

        return $this;
    }

    public function where($key, $val): DynamicQuery
    {
        $this->where_clause_query .= " {$key} = ? ";
        $this->where_clause_data[] = $val;

        return $this;
    }

    public function whereByArray($params): DynamicQuery
    {
        foreach ($params as $key => $val) {
            $this->where_clause_data .= " {$key} = ?, ";
            $this->where_clause_data[] = $val;
        }

        return $this;
    }

    public function and(): DynamicQuery
    {
        $this->where_clause_query = rtrim($this->where_clause_query, ", ");
        $this->where_clause_query .= " and ";

        return $this;
    }

    public function or(): DynamicQuery
    {
        $this->where_clause_query = rtrim($this->where_clause_query, ", ");
        $this->where_clause_query .= " or ";

        return $this;
    }

    public function run(): bool
    {
        $query = $this->getQuery();
        $stmt = $this->connection->prepare($query);
        $types = $this->createTypes($this->set_clause_data);
        $types .= $this->createTypes($this->where_clause_data);
        $stmt->bind_param($types, ...array_merge($this->set_clause_data, $this->where_clause_data));

        return $stmt->execute();
    }

    private function getQuery(): string
    {
        return $this->update_query . " {$this->table} " . " SET " . rtrim($this->set_clause_query, ", ") . " WHERE " . rtrim($this->where_clause_query, ", ");
    }

    private function createTypes($data): string
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