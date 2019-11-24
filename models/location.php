<?php
namespace FSR_AI;

use mysql_xdevapi\Statement;

class location
{
    const TABLENAME ='location';
    private $street;
    private $number;
    private $zipcode;
    private $city;
    private $room;

    public function __construct($street, $number, $zipcode, $city, $room){

        $this->street = $street;
        $this->number = $number;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->room = $room;
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
            $sql = 'INSERT INTO '.self::TABLENAME.' (street, number, zipcode, city, room) VALUES (:street, :number, :zipcode, :city, :room)';
            $statement = $db->prepare($sql);

            $statement->bindParam(':street',$this->street);
            $statement->bindParam(':number', $this->number);
            $statement->bindParam(':zipcode', $this->zipcode);
            $statement->bindParam(':city', $this->city);
            $statement->bindParam(':room', $this->room);

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