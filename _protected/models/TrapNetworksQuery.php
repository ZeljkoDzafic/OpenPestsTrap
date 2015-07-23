<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TrapNetworks]].
 *
 * @see TrapNetworks
 */
class TrapNetworksQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TrapNetworks[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TrapNetworks|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}