<?php
/**
 * @author Vadim Trunov <vadim.tr@bigdropinc.com>
 *
 * @copyright (C) 2017 - Bigdrop Inc
 *
 * @license https://opensource.org/licenses/BSD-3-Clause
 */

namespace bigdropinc\take;


use bigdropinc\take\exceptions\RecordNotFoundException;
use yii\web\NotFoundHttpException;

class ErrorHandler extends \yii\web\ErrorHandler
{

    /**
     * Converts a RecordNotFoundException to a NotFoundHttpException
     *
     * @param $exception
     * @return mixed
     */
    public function handleException($exception)
    {
        if($exception instanceof RecordNotFoundException){
            $exception = new NotFoundHttpException();
        }
        return parent::handleException($exception);
    }

}