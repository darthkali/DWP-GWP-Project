<?php
namespace FSR_AI;

use mysql_xdevapi\Statement;

class events extends \BaseModel
{
    const TABLENAME ='events';
    private $eventName;
    private $eventDate;
    private $eventDescription;
    private $picturePath;
    private $eventLocation_id;
    private $eventCreated_from;

    public function __construct($name, $date, $description, $picturePath, $location_id, $eventCreated_from){

        $this->eventName = $name;
        $this->eventDate = $date;
        $this->eventDescription = $description;
        $this->picturePath = $picturePath;
        $this->eventLocation_id = $location_id;
        $this->eventCreated_from = $eventCreated_from;
    }

    public function insert(){

        $db = $GLOBALS['db'];
        try{
            $sql = 'INSERT INTO '.self::TABLENAME.' (name, date, description, picture, location_id, created_from) 
            VALUES (:name, :date, :description, :picture, :location_id, :created_from)';
            $statement = $db->prepare($sql);

            $statement->bindParam(':name',$this->eventName);
            $statement->bindParam(':date', $this->eventDate);
            $statement->bindParam(':description', $this->eventDescription);
            $statement->bindParam(':picture', $this->picturePath);
            $statement->bindParam(':location_id', $this->eventLocation_id);
            $statement->bindParam(':created_from', $this->eventCreated_from);

            $statement->execute();
            return true;
        }catch(\PDOException $e){
            die('INSERT statement failed: '.$e->getMessage());
        }
        return false;
    }

    public function delete(){

        $db = $GLOBALS['db'];
        try{

            $sql = 'DELETE FROM '.self::TABLENAME.'WHERE name = '.$this->eventName;
            $db->exec($sql);
            return true;
        }catch(\PDOException $e){
            die('DELETE statement failed: '.$e->getMessage());
        }
        return false;
    }
}