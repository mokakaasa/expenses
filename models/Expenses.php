<?php

namespace app\models;
use yii;
use yii\db\ActiveRecord;

class Expenses extends ActiveRecord
{
    public static function tableName()
    {
        return 'expense';
    }
    public function rules()
    {
        return [
            [['quantity','unit_price','amount','expensedate'], 'required'],
            [['quantity','unit_price','amount'],'number'],
            [['expensedate'],'date'],
            [['expense_category_id'],'safe'],
            [['expense_category_id'],'exist','targetClass'=>'\app\models\Expensescategory','targetAttribute'=>'id'],

        ];
    }
    public function attributeLabels()
    {
        return[
            'expense_category_id'=>"Expense(s) Category Name",
            'quantity' => "Expenses's Quantity",
            'unit_price' => "Expenses's Price",
            'amount' => "Expenses's Amount",
            'expensedate' => "Date the Expenses was created",
        ];
    }
    public function getExpensescategory()
    {
      return $this->hasOne(Expensescategory::class,['id'=>'expense_category_id']) ;
    }
    public function createExpenses()
    {
        $this->amount=$this->quantity * $this->unit_price;
        return $this->save() ;
    }
    public function createNewExpenses()
    {
        $this->amount=$this->quantity * $this->unit_price;
        return $this->save() ;
    }

    public function createUpdate()
    {
        $this->quantity;
        $this->unit_price;
        $this->expensedate ;
        $this->amount=$this->quantity * $this->unit_price;
        return $this->save() ;
    }

    public function createsoftDelete()
    {
        $this->is_deleted = 1;
        return  $this->save(false);
    }
    public function createreverse()
    {
        $this->is_deleted=0;
        return $this->save(false);
    }
}