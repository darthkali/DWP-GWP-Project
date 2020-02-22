<?php
namespace FSR_AI;

use PDOException;

abstract class BaseModel{
    const TYPE_INT    = 'int';
    const TYPE_FLOAT  = 'float';
    const TYPE_STRING = 'string';

    protected $schema = []; // schema for the database table (attribute names from the Table)
    protected $data   = [];  // data which goes into the table

    // baseModel constructor
    public function __construct($params){
        foreach ($this->schema as $key => $value){
            if(isset($params[$key])){
                $this->{$key} = $params[$key];
            }else{
                $this->{$key} = null;
            }
        }
    }

    // magic method to get $data files
    public function  __get($key){
        if(array_key_exists($key, $this->data)){
            return $this->data[$key];
        }
        $message = 'You can not access to property "'.$key.'"" for the class "'.get_called_class();
        error_to_logFile($message);
        throw new \Exception($message);
    }

    // megic method to set $data files
    public function  __set($key, $value){
        if(array_key_exists($key, $this->schema)){
            $this->data[$key] = $value;
            return;
        }
        $message = 'You can not access to property "'.$key.'"" for the class "'.get_called_class();
        error_to_logFile($message);
        throw new \Exception($message);
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

            $db->beginTransaction();
            $statement->execute();
            $db->commit();

            return true;
        }
        catch(PDOException $e){
            $errors[] = 'Error inserting '.get_called_class();
            foreach($errors  as $error){
                error_to_logFile($error);
            }
            $db->rollBack();
        }
        return false;
    }

    // update an entity in the database
    protected function update(&$errors){
        $db = $GLOBALS['db'];

        try{
            $sql ='UPDATE ' . self::tablename() . ' SET ';

            foreach ($this->schema as $key => $schemaOptions){
                if($this->data[$key] !== null){
                    $sql .= $key . ' = ' . $db->quote($this->data[$key]).',';
                }
            }

            $sql = trim($sql, ',');
            $sql .= ' WHERE id = ' . $this->data['ID'];
            $statement = $db->prepare($sql);

            $db->beginTransaction();
            $statement->execute();
            $db->commit();

            return true;
        }
        catch(PDOException $e){
            $errors[] = 'Error updating '.get_called_class();
            foreach($errors  as $error){
                error_to_logFile($error);
            }
            $db->rollBack();
        }
        return false;
    }

    public static function deleteWhere($where){
        $db = $GLOBALS['db'];
        try{
            $sql = 'DELETE FROM ' . self::tablename() . ' WHERE ' . $where;

            $db->beginTransaction();
            $db->exec($sql);
            $db->commit();

            return true;
        }
        catch(PDOException $e){
            $errors[] = 'Error deleting '.get_called_class();
            foreach($errors  as $error){
                error_to_logFile($error);
            }
            $db->rollBack();
        }
        return false;
    }

    public function validate(&$errors){
        foreach($this->schema as $key => $schemaOptions){
            if(isset($this->data[$key]) && is_array($schemaOptions)){
                $valueErrors = $this->validateValue($key, $this->data[$key], $schemaOptions);

                if(is_array($valueErrors)){
                    array_push($errors, ...$valueErrors);
                }
            }
        }
        if(count($errors) == 0){
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
                    $errors[] = $attribute.': Eingabe muss mindestens aus '.$schemaOptions['min'].' Zeichen bestehen!';
                }
                if(isset($schemaOptions['max']) && mb_strlen($value) > $schemaOptions['max']){
                    $errors[] = $attribute.': Eingabe darf maximal aus '.$schemaOptions['max'].' Zeichen bestehen!';
                }
            }
            break;
        }

        return count($errors) > 0 ? $errors : true;
    }

    // gives the tablename from the class
    public static function tablename(){
        $class = get_called_class();
        if(defined($class.'::TABLENAME')) {
            return $class::TABLENAME;
        }
        return null;
    }

    public static function find($where = '', $viewName = null, $orderBy = ''){
        $db  = $GLOBALS['db'];
        $result = null;

        try {
            if(!$viewName) {
               $viewName = self::tablename();
            }

            $sql = 'SELECT * FROM ' . $viewName;
            if(!empty($where))
            {
                $sql .= ' WHERE ' . $where . ' ' . $orderBy.  ';';
            }
            $sql .= ' '.$orderBy;
            $result = $db->query($sql)->fetchAll();
        }
        catch(PDOException $e) {
            $message = 'Select statment failed: ' . $e->getMessage();
            error_to_logFile($message);
            die($message);
        }

        return $result;
    }

    public static function findOne($where = ''){
        $db  = $GLOBALS['db'];
        $result = null;

        try{
            $sql = 'SELECT * FROM ' . self::tablename();

            if(!empty($where)){
                $sql .= ' WHERE ' . $where .  ';';
            }
            $result = $db->query($sql)->fetch();
        }
        catch(PDOException $e){
            $message = 'Select statment failed: ' . $e->getMessage();
            error_to_logFile($message);
            die($message);
        }
        return $result;
    }

    public static function putTheUploadedFileOnTheServerAndRemoveTheOldOne($inputFieldName, $filePath, $fileName, $pictureName ){
        if (basename($_FILES[$inputFieldName]['name']) != null) {
            unlink($filePath.$fileName);
            $picturePath = $filePath.$pictureName;
            move_uploaded_file($_FILES[$inputFieldName]['tmp_name'], $picturePath);
            return $pictureName;
        }
      return null;
    }

    public static function createUploadedPictureName($uploadedPictureFile){
        return strtolower(str_replace(__NAMESPACE__ . '\\', '', get_called_class())).'-'.date('d-m-Y-H-i-s').strstr($_FILES[$uploadedPictureFile]['name'], '.');
    }



}