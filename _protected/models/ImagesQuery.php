<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Images]].
 *
 * @see Images
 */
class ImagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Images[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Images|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}