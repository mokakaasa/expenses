<?php

namespace app\models;

use app\models\Expensescategory;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class ExpensescategorySearch extends Expensescategory
{

    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 50],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params)
    {
        $query=Expensescategory::find();

        $expensescategorydataProvider= new ActiveDataProvider([
            'query'=>$query,
            'pagination'=>array('pageSize'=>5),]);

        $this->load($params);

        $query->andFilterWhere([
            'id' =>$this->id,
            'name' =>$this->name,
            'description' =>$this->description,
            'is_deleted' =>0,
        ]);

        $query->andFilterWhere(['like','name',$this->name]);
        $query->orderBy('name');
        return $expensescategorydataProvider;
    }
    public function filterDeleted($params)
    {
        $query = Expensescategory::find();

        // add conditions that should always apply here

        $expensescategorydataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $params['id'] ?? null,
            'name' => $this->name,
            'description'=>$this->description,
            'is_deleted' =>1,
        ]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->orderBy('name');
        return  $expensescategorydataProvider;
    }

}