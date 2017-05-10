<?php
/**
 * @author Vadim Trunov <vadim.tr@bigdropinc.com>
 *
 * @copyright (C) 2017 - Bigdrop Inc
 *
 * @license https://opensource.org/licenses/BSD-3-Clause
 */

namespace bigdropinc\take\exceptions;

use yii\base\UserException;

abstract class BaseRecordException extends UserException
{
    private $record;

    public function getRecord()
    {
        return $this->record;
    }

    public function __construct($record, $message = "", $code = 0, \Throwable $previous = null)
    {
        $this->record = $record;
        parent::__construct($message, $code, $previous);
    }
}