<?php

class Task
{
    //DB info
    private static $conn;
    private static $table = "tasks";

    //Object properties
    public $id;
    public $taskName;
    public $taskRecord;
    public $deadline;
    

    public function __construct($db)
    {
        self::$conn = $db;
    }

    public function create()
    {
        $sql = "INSERT INTO ".self::$table." SET taskName=:taskName,taskRecord=:taskRecord, deadline=:deadline";
        $query = self::$conn->prepare($sql);

        //bind  values
        $query->bindParam(":taskName", $this->taskName);
        $query->bindParam(":taskRecord", $this->taskRecord);
        $query->bindParam(":deadline", $this->deadline);
       
   

        if($query->execute()){
            return true;
        } else {
            return false;
        }
    }

    public static function index($db){
        //prisidedame prijungima prie DB
        self::$conn = $db;

        //duomenu istraukimas
        $sql = "SELECT * FROM ".self::$table;
        $query = self::$conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();

        //graziname duomenu masyva
        return $result;
    }

    public function update()
    {
        $sql = "UPDATE ".self::$table." SET 
        taskName = :taskName,
        taskRecord = :taskRecord,
        deadline = :deadline
        WHERE id = :id";

        $query = self::$conn->prepare($sql);

        $query->bindParam(':taskName', $this->taskName);
        $query->bindParam(':taskRecord', $this->taskRecord);
        $query->bindParam(':deadline', $this->deadline);
        $query->bindParam(':id', $this->id);

        if($query->execute()){
            return true;
        } else {
            return false;
        }
    
    }

    public function getOne() 
    {
        //gauname vieno įrašo duomenis pagal id 
        $sql = "SELECT * FROM ".self::$table." WHERE id = ".$this->id;
        $query = self::$conn->prepare($sql);
        $query->execute();
        $result = $query->fetch();

        // priskiriame duomenis savybėms
        $this->taskName = $result['taskName'];
        $this->taskRecord = $result['taskRecord'];
        $this->deadline = $result['deadline'];
    }

    public function delete()
    {
        $sql = "DELETE FROM " . self::$table . " WHERE id = ".$this->id;

        $query = self::$conn->prepare($sql);

        if($query->execute()){
            return true;
        } else {
            return false;
        }
    }
}