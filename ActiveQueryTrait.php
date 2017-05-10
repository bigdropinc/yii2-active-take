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

trait ActiveQueryTrait
{

    /**
     * Twin of findAll method with raising RecordNotFoundException
     *
     * @param null $db
     * @return array
     */
    public function takeAll($db = null)
    {
        if (empty($result = $this->all($db))) {
            throw new RecordNotFoundException();
        }
        return $result;
    }

    /**
     * Twin of findAll method with raising RecordNotFoundException
     *
     * @param null $db
     * @return yii\db\ActiveRecord
     */
    public function takeOne($db = null)
    {
        if (empty($result = $this->one($db))) {
            throw new RecordNotFoundException();
        }
        return $result;
    }
}