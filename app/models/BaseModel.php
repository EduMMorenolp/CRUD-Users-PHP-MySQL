<?php
class BaseModel
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}
?>