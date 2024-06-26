<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use \common\traits\base\BeforeQueryTrait;
use \common\traits\SoftDeleteBoolTrait;

class Expensescategory extends ActiveRecord
{
    public static function tableName()
    {
        return 'expensecategories';
    }

    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['name', 'description'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Expense(s) Category Name',
            'description' => 'Expense(s) Category Description',
        ];
    }

    public function getExpenses()
    {
        return $this->hasMany(Expenses::class, ['expense_category_id' => 'id']);
    }
    public function createExpensesCategory()
    {

        return $this->save();
    }

    public function createNewExpensesCategory()
    {
        return $this->save();
    }

    public function createUpdate()
    {
        $this->description;
        return $this->save();
    }

    public function createsoftDelete()
    {
        $this->is_deleted = 1;
        return $this->save(false);
    }

    public function createreverse()
    {
        $this->is_deleted=0;
        return $this->save(false);
    }

}