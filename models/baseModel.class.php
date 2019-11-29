<?php

abstract class BaseModel
{
    const TYPE_INT = 'int';
    const TYPE_FLOAT = 'float';
    const TYPE_STRING = 'string';

    protected $schema = []; // schema for the database table (attribute names from the Ttable)
    protected $data = [];  // data which goes into the table


    // baseModel constructor
    public function __construct($params)
    {
        foreach ($this->schema as $key => $value){
            if(isset($key)){
                $this->{$key} = $params[$key];
            }else{
                $this->{$key} = null;
            }
        }
    }


    // megic method to get $data files
    public function  __get($key)
    {
        if(array_key_exists($key, $this->data)){
            return $this->data[$key];
        }
        throw new \Exception('You can not access to property "'.$key.'"" for the class "'.get_called_class());
    }

    // megic method to set $data files
    public function  __set($key, $value)
    {
        if(array_key_exists($key, $this->schema)){
            $this->data[$key] = $value;
            return;
        }
        throw new \Exception('You can not access to property "'.$key.'"" for the class "'.get_called_class());
    }


    public function insert(&$errors){
        $db = $GLOBALS['db'];

        try{
            $sql = 'INSERT INTO ' . self::tablename() . ' ()';
            $valueString = ' VALUES (';

            foreach ($this->schema as $key => $schemaOptions){
                $sql .= '`'.$key.'`,';

                if($this->data[$key] === null){
                    $valueString .= 'NULL,';
                }else{
                    $valueString .= $db->quote($this->data[$key]). ',';
                }
            }

            $sql = trim($sql, ',');
            $valueString = trim($valueString, ',');
            $sql .= ')'.$valueString.');';

            $statement = $db->prepare($sql);
            $statement->execute();

            return true;

        }
        catch(\PDOException $e){
            $errors[] = 'Error inserting '.get_called_class();
        }
        return false;
    }














    public static function tablename()
    {
        $class = get_called_class();
        if(defined($class.'::TABLENAME'))
        {
            return $class::TABLENAME;
        }
        return null;
    }

    public static function find($where = '')
    {
        $db  = $GLOBALS['db'];
        $result = null;

        try
        {
            $sql = 'SELECT * FROM ' . self::tablename();
                
            if(!empty($where))
            {
                $sql .= ' WHERE ' . $where .  ';';
            }
                    
            $result = $db->query($sql)->fetchAll();
        }
        catch(\PDOException $e)
        {
            die('Select statment failed: ' . $e->getMessage());
        }

        return $result;
    }
}