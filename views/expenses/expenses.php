<?php

use app\models\Expenses;
use app\models\Expensessearch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\widgets\LinkPager;
use yii\data\Pagination;

/** @var yii\web\View $this */
/** @var app\models\Expensessearch $expensesearch */
/** @var app\models\Expenses $expenses */
/** @var yii\data\ActiveDataProvider $expensesdataProvider */
/** @var yii\data\ActiveDataProvider $pagination */


$this->title = 'LIST OF ALL EXPENSES';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('EXPENSES')):?>

    <div class="alert alert-success">
        'A NEW EXPENSE RECORD WAS CREATED SUCCESSFULLY'
    </div>

<?php endif; ?>

<div class="expense-index">
    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $expensesdataProvider,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['width' => '300'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'update' => function ($url,$expenses, $key) {
                        return Html::a('Update Expenses' ,$url, ['class' => 'btn btn-info']);
                    },
                    'view' => function ($url,$expenses, $key){
                        return Html::a('View  Expenses' , ['/expenses/view', 'id' => $expenses->id,], ['class' => 'btn btn-info']);
                    },
                    'delete' => function ($url, $expenses, $key) {
                        return Html::a('Delete  Expenses' , $url, ['class' => 'btn btn-info']);
                    }


                ],
            ],
            [
                    'attribute' => 'expense_category_id',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->expensescategory->name;
                    },
            ],
            'unit_price',
            'quantity',
            'amount',
            'expensedate',
        ],


    ]); ?>

</div>

<p>
    <?= Html::a('Create New Expenses', ['new-expenses'], ['class' => 'btn btn-success']) ?>
</p>

<p>
    <?= Html::a('View Trashed Expenses', ['deleted-item'], ['class' => 'btn btn-success']) ?>
</p>


</div>

