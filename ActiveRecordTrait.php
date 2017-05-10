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

    public static function __callStatic($name, $arguments)
    {
        if(strpos($name, 'take') === 0){
            $method = str_replace('take', 'find', $name );
            if(method_exists(static::class, $method)){
                $result = call_user_func([static::class, $method], $arguments);
                if(empty($result)){
                    throw new RecordNotFoundException();
                }
                return $result;
            }
        }
    }

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

    public function takeValidate($attributeNames = null, $clearErrors = true)
    {
        if(!$this->validate($attributeNames, $clearErrors)){
            throw new RecordInvalidException($this);
        };
        return true;
    }

}