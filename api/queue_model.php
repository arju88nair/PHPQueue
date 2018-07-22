<?php

/**
 * Description of queue
 */
class Queue
{
    // database connection and table name
    private $conn;
    private $table_name = "queue";

    // object properties
    public $id;
    public $body;
    public $queuedDate;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     *
     * @return list
     */
    function getQueues($filter)
    {

        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    queuedDate DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    /**
     *
     * @return boolean
     */
    function create()
    {

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    body=:body, queuedDate=:queuedDate ";

        // prepare query
        $stmt = $this->conn->prepare($query);



        // sanitize
        $this->body = $this->prepareString($this->body);
        $this->queuedDate = htmlspecialchars(strip_tags($this->queuedDate));


        // bind values
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":queuedDate", $this->queuedDate);

        // execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        } else {
            return false;
        }
    }


    /**
     * @return list
     */

    function getOne()
    {
// select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                LIMIT 1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

/*
 * Return boolean
 */
    function removeOne($id)
    {
        // query to remove record
        $query = "DELETE FROM  
                  " . $this->table_name . " 
                  WHERE
                   id =:id ";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id = $this->prepareString($id);

        // bind values
        $stmt->bindParam(":id", $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    private function prepareString($value)
    {
        return ($value . "" == "") ? null : htmlspecialchars(strip_tags($value));
    }

}
