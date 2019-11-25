<?php
namespace FSR_AI;

use mysql_xdevapi\Statement;

class events
{
    const TABLENAME ='events';

    private $eventName;
    private $eventDate;
    private $eventDescription;
    private $picturePath;
    private $eventLocation_id;

    public function __construct($eventName, $date, $description, $picturePath, $location_id){

        $this->eventName = $eventName;
        $this->eventDate = $date;
        $this->eventDescription = $description;
        $this->picturePath = $picturePath;
        $this->eventLocation_id = $location_id;

    }

    public static function find( $where = ''){

        $db = $GLOBALS['db'];
        $result = null;

       try{
           $sql = 'SELECT * FROM '.self::TABLENAME;
            if(!empty($where)){
                $sql .'WHERE=  '.$where.';';
            }
            $result = $db->query($sql)->fetchAll();
        }catch(\PDOException $e){
            die('SELECT statement failed: '.$e->getMessage());
        }
        return $result;
    }
    public function insert(){

        $db = $GLOBALS['db'];
        try{
            $sql = 'INSERT INTO '.self::TABLENAME.' (name, date, description, picture, location_id) VALUES (:name, :date, :description, :picture, :location_id)';
            $statement = $db->prepare($sql);

            $statement->bindParam(':name',$this->eventName);
            $statement->bindParam(':date', $this->eventDate);
            $statement->bindParam(':description', $this->eventDescription);
            $statement->bindParam(':picture', $this->picturePath);
            $statement->bindParam(':location_id', $this->eventLocation_id);

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