<?php

abstract class BaseModel
{
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