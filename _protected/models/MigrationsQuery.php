<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Migrations]].
 *
 * @see Migrations
 */
class MigrationsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Migrations[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Migrations|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}