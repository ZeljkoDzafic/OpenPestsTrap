<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PestFamilies]].
 *
 * @see PestFamilies
 */
class PestFamiliesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return PestFamilies[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PestFamilies|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}