<?php
/**
 * @author Vadim Trunov <vadim.tr@bigdropinc.com>
 *
 * @copyright (C) 2017 - Bigdrop Inc
 *
 * @license https://opensource.org/licenses/BSD-3-Clause
 */

namespace bigdropinc\take;

use common\models\RecordNotFoundException;
use yii\web\NotFoundHttpException;

class ErrorHandler extends \yii\web\ErrorHandler
{
    public function handleException($exception)
    {
        if($exception instanceof RecordNotFoundException){
            $exception = new NotFoundHttpException();
        }
        return parent::handleException($exception);
    }

}