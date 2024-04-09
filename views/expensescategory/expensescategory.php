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
/** @var app\models\ExpensescategorySearch $expensescategorysearch */
/** @var app\models\Expensescategory $expensescategory */
/** @var yii\data\ActiveDataProvider $expensescategorydataProvider */
/** @var yii\data\ActiveDataProvider $pagination */

$this->title = 'LIST OF ALL EXPENSE(s) CATEGORY';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('EXPENSE(S) CATEGORY')):?>

    <div class="alert alert-success">
        'A NEW EXPENSE(s) CATEGORY RECORD WAS CREATED SUCCESSFULLY'
    </div>

<?php endif; ?>

<div class="expensescategory-index">
    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $expensescategorydataProvider,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['width' => '300'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $expensescategory, $key) {
                        return Html::a('Update Expense(s) Category' ,$url, ['class' => 'btn btn-info']);
                    },
                    'view' => function ($url, $expensescategory, $key) {
                        return Html::a('View Expense(s) Category' ,$url, ['class' => 'btn btn-info']);
                    },
                    'delete' => function ($url,$expensescategory, $key) {
                        return Html::a('DeleteExpense(s) Category' , ['/expensescategory/delete', 'id' => $expensescategory->id,], ['class' => 'btn btn-info']);
                    }


                ],
            ],
            'name',
            'description',
        ],
    ]); ?>

</div>

<p>
    <?= Html::a('Create New Expense(s) Category', ['new-expenses-category'], ['class' => 'btn btn-success']) ?>
</p>

<p>
    <?= Html::a('View Trashed Expense(s) Category', ['deleted-item'], ['class' => 'btn btn-success']) ?>
</p>
</div>
