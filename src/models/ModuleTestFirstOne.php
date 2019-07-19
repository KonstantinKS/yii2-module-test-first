<?php

declare(strict_types=1);

namespace KonstantinKS\ModuleTestFirst\models;

use yii\db\ActiveRecord;

class ModuleTestFirstOne extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%module_test_first_one}}';
    }

    public function rules()
    {
        return [
            [['ip'], 'ip'],
            [['comment'], 'required'],
        ];
    }
}
