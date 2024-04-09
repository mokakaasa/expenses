<?php

use app\models\Expensescategory;
use app\models\ExpensescategorySearch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\SerialColumn;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\widgets\LinkPager;
use yii\data\Pagination;

/** @var yii\web\View $this */
/** @var app\models\ExpensesSearch $expensesearchModel */
/** @var app\models\Expensescategory $expensescategory */
/** @var app\models\Expenses $expenses*/
/** @var yii\data\ActiveDataProvider $expensesdataProvider */
/** @var yii\data\ActiveDataProvider $pagination */

$this->title = 'EXPENSE(s) DETAILS';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="viewexpenses-index">
    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $expensesdataProvider,
        'columns'=>[
            ['class'=>'yii\grid\SerialColumn'],
            [
                'attribute' => 'expense_category_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->expensescategory->name;
                },
            ],
        'quantity',
        'unit_price',
        'amount',
        'expensedate',
        ],
    ]); ?>
</div>

</div>
