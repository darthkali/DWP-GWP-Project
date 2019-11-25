<?php
namespace FSR_AI;

use mysql_xdevapi\Statement;

class events
{
    const TABLENAME ='events';
    private $data;
    private $topic;
    private $date;
    private $description;
    private $picturePath;
    private $location_id;

    public function __construct($topic, $date, $description, $picturePath, $location_id){

        $this->topic = $topic;
        $this->date = $date;
        $this->description = $description;
        $this->picturePath = $picturePath;
        $this->location_id = $location_id;

    }

    public function __get($key){
        if(isset($this->data[$key])){
            return $this->data[$key];
        }
    }

    public function __set($name, $value){
        // TODO: Implement __set() method.
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

            $statement->bindParam(':name',$this->topic);
            $statement->bindParam(':date', $this->date);
            $statement->bindParam(':description', $this->description);
            $statement->bindParam(':picture', $this->picturePath);
            $statement->bindParam(':location_id', $this->location_id);

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

            $sql = 'DELETE FROM '.self::TABLENAME.'WHERE topic = '.$this->topic;
            $db->execute();
            return true;


        }catch(\PDOException $e){
            die('DELETE statement failed: '.$e->getMessage());
        }
        return false;
    }
}