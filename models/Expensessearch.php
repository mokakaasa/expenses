<?php

namespace app\models;

use app\models\Expenses;
use app\models\Expensescategory;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class Expensessearch extends Expenses
{
    public function rules()
    {
        return [
            [['quantity', 'unit_price', 'amount', 'expensedate'], 'required'],
            [['quantity', 'unit_price', 'amount'], 'number'],
            [['expensedate'], 'date'],
            [['expense_category_id'], 'safe'],
            [['expense_category_id'], 'exist', 'targetClass' => '\app\models\Expensescategory', 'targetAttribute' => 'id'],

        ];
    }

    public function scenarios()
    {

        // bypass scenarios() implementation in the parent class
        return Model::scenarios();

    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */

    public function search($params)
    {
        $query = Expenses::find();
        $expensesdataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array(
                'pageSize' => 10,
            ),
        ]);


        $this->load($params);


        // grid filtering conditions
        $query->andFilterWhere([
            'unit_price' => $this->unit_price,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'expensedate' => $this->expensedate,
            'is_deleted' => 0,
        ]);
        return $expensesdataProvider;
    }

    public function filterDeleted($params)
    {
        $query = Expenses::find();

        // add conditions that should always apply here

        $expensesdataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        // grid filtering conditions
        $query->andFilterWhere([
            'unit_price' => $this->unit_price,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'expensedate' => $this->expensedate,
            'is_deleted' => 0,
        ]);
        return $expensesdataProvider;
    }

    public function viewExpenses($params)
    {
        $query = Expenses::find();

        $expensesdataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->joinWith('expensescategory');

        $query->andFilterWhere([
            'expense.id' => $params['id'] ?? null,
            'unit_price' => $this->unit_price,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'expensedate' => $this->expensedate,
            'expense.is_deleted' =>0,
        ]);
        $query->andFilterWhere(['like', 'expensecategories.name', $this->expense_category_id]);

        return $expensesdataProvider;
    }


}