<?php
namespace FSR_AI;

use mysql_xdevapi\Statement;

class location
{
    const TABLENAME ='location';
    private $locationStreet;
    private $locationNumber;
    private $locationZipcode;
    private $locationCity;
    private $locationRoom;

    public function __construct($street, $number, $zipcode, $city, $room = null){

        $this->locationStreet = $street;
        $this->locationNumber = $number;
        $this->locationZipcode = $zipcode;
        $this->locationCity = $city;
        $this->locationRoom = $room;
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
            $sql = 'INSERT INTO '.self::TABLENAME.' (street, number, zipcode, city, room) VALUES (:locationStreet, :locationNumber, :locationZipcode, :locationCity, :locationRoom)';
            $statement = $db->prepare($sql);

            $statement->bindParam(':locationStreet',$this->locationStreet);
            $statement->bindParam(':locationNumber', $this->locationNumber);
            $statement->bindParam(':locationZipcode', $this->locationZipcode);
            $statement->bindParam(':locationCity', $this->locationCity);
            $statement->bindParam(':locationRoom', $this->locationRoom);

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