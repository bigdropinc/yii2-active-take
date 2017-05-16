<?php
/**
 * @author Vadim Trunov <vadim.tr@bigdropinc.com>
 *
 * @copyright (C) 2017 - Bigdrop Inc
 *
 * @license https://opensource.org/licenses/BSD-3-Clause
 */

namespace bigdropinc\take;

use bigdropinc\take\exceptions\RecordInvalidException;
use bigdropinc\take\exceptions\RecordNotFoundException;
use bigdropinc\take\exceptions\RecordNotSavedException;



trait ActiveRecordTrait
{

    /**
     * In this method is paste a logic of all 'take'-methods such a static::takeOne
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function processTake($name, $arguments)
    {
        if(($method = static::getTakeMagicMethod($name))){
            return static::callTakeMethod($method, $arguments);
        }
    }

    /**
     * Direct call of take methods
     *
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public static function callTakeMethod($method, $arguments)
    {
        $result = call_user_func([static::class, $method], $arguments);
        if(empty($result)){
            throw new RecordNotFoundException();
        }
        return $result;
    }

    /**
     * Get name of take method
     *
     * @param $name
     * @return bool|mixed
     */
    public static function getTakeMagicMethod($name)
    {
        if(strpos($name, 'take') === 0){
            $method = str_replace('take', 'find', $name );
            if(method_exists(static::class, $method)){
                return $method;
            }
        }
        return false;
    }

    /**
     * Check if method can be process as take-method
     *
     * @param $name
     * @return bool
     */
    public static function isTakeCanProcess($name)
    {
        return !empty(static::getTakeMagicMethod($name));
    }


    /**
     * Perform standard save, but raise an exception on fail
     *
     * @param bool $runValidation
     * @param null $attributeNames
     * @return bool
     */
    public function takeSave($runValidation = true, $attributeNames = null)
    {
        if(!$this->save($runValidation, $attributeNames)){
            if($this->hasErrors()){
                throw new RecordInvalidException($this);
            } else {
                throw new RecordNotSavedException($this);
            }
        }
        return true;
    }

    /**
     * Perform standard validation, but raise an exception on fail
     *
     * @param null $attributeNames
     * @param bool $clearErrors
     * @return bool
     */
    public function takeValidate($attributeNames = null, $clearErrors = true)
    {
        if(!$this->validate($attributeNames, $clearErrors)){
            throw new RecordInvalidException($this);
        };
        return true;
    }

}