<?php
namespace FSR_AI;

abstract class BaseModel
{
    const TYPE_INT = 'int';
    const TYPE_FLOAT = 'float';
    const TYPE_STRING = 'string';

    protected $schema = []; // schema for the database table (attribute names from the Table)
    protected $data = [];  // data which goes into the table

    // baseModel constructor
    public function __construct($params)
    {
        foreach ($this->schema as $key => $value){
            if(isset($params[$key])){
                $this->{$key} = $params[$key];
            }else{
                $this->{$key} = null;
            }
        }
    }

    // magic method to get $data files
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

    //decides if we have an id, then the entity is already there, than we take the update, else we need an insert
    public function save(&$errors = null){
        if($this->ID === null){
            $this->insert($errors);
        }else{
            $this->update($errors);
        }
    }

    // insert an entity to the database
    protected function insert(&$errors){
        $db = $GLOBALS['db'];

        try{
            $sql = 'INSERT INTO ' . self::tablename() . ' (';
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

    // update an entity in the database
    protected function update(&$errors){
        $db = $GLOBALS['db'];

        try{
            $sql ='UPDATE ' . self::tablename() . ' SET';

            foreach ($this->schema as $key => $schemaOptions){
                if($this->data[$key] !== null){
                    $sql .= $key . ' = ' . $db->quote($this->data[$key]).',';
                }
            }

            $sql = trim($sql, ',');
            $sql .= ' WHERE id = ' . $this->data['id'];

            $statement = $db->prepare($sql);
            $statement->execute();
            return true;

        }
        catch(\PDOException $e){
            $errors[] = 'Error updating '.get_called_class();
        }
        return false;
    }

    // deletes an entity from the database
    public function delete(&$errors = null){
        $db = $GLOBALS['db'];

        try{
            $sql = 'DELETE ' . 'FROM ' . self::tablename() . ' WHERE id = ' . $this->id;
            $db->exec($sql);
            return true;

        }
        catch(\PDOException $e){
            $errors[] = 'Error deleting '.get_called_class();
        }
        return false;
    }

    public static function deleteWhereUserIdEventId($where){
        $db = $GLOBALS['db'];

        try{
            $sql = 'DELETE ' . 'FROM ' . self::tablename() . ' WHERE ' . $where;
            $db->exec($sql);
            return true;

        }
        catch(\PDOException $e){
            $errors[] = 'Error deleting '.get_called_class();
        }
        return false;
    }

    public function validate(&$errors = null){
        foreach($this->schema as $key => $schemaOptions){
            if(isset($this->data[$key]) && is_array($schemaOptions)){
                $valueErrors = $this->validateValue($key, $this->data[$key], $schemaOptions);

                if($valueErrors != true){
                    array_push($errors, ...$valueErrors);
                }
            }
        }
        if(count($errors) === 0){
            return true;
        }else{
            return false;
        }
    }

    // check the if the value is correct
    protected function  validateValue($attribute, &$value, &$schemaOptions){
        $type = $schemaOptions['type'];
        $errors = [];

        switch ($type){
            case BaseModel::TYPE_INT:
            case BaseModel::TYPE_FLOAT:
                break;
            case BaseModel::TYPE_STRING:{
                if(isset($schemaOptions['min']) && mb_strlen($value) < $schemaOptions['min']){
                    $errors[] = $attribute.': String needs min. '.$schemaOptions['min'].' characters!';
                }
                if(isset($schemaOptions['max']) && mb_strlen($value) < $schemaOptions['max']){
                    $errors[] = $attribute.': String can have max. '.$schemaOptions['max'].' characters!';
                }
            }
            break;
        }
        return count($errors) > 0 ? $errors : true;
    }

    // gives the tablename from the class
    public static function tablename()
    {
        $class = get_called_class();
        if(defined($class.'::TABLENAME'))
        {
            return $class::TABLENAME;
        }
        return null;
    }

    public static function find($where = '', $viewName = null, $orderBy = '')
    {
        $db  = $GLOBALS['db'];
        $result = null;

        try
        {
            if(!$viewName) {
               $viewName = self::tablename();
            }

            $sql = 'SELECT * FROM ' . $viewName;
            if(!empty($where))
            {
                $sql .= ' WHERE ' . $where .  ';';
            }
            $sql .= ' '.$orderBy;
                    
            $result = $db->query($sql)->fetchAll();
        }
        catch(\PDOException $e)
        {
            die('Select statment failed: ' . $e->getMessage());
        }

        return $result;
    }

    public static function findOne($where = '')
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

            $result = $db->query($sql)->fetch();
        }
        catch(\PDOException $e)
        {
            die('Select statment failed: ' . $e->getMessage());
        }

        return $result;
    }
}