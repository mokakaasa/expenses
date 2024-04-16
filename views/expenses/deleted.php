<?php

use app\models\Expenses;
use app\models\ExpensesSearch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\widgets\LinkPager;
use yii\data\Pagination;

/** @var yii\web\View $this */
/** @var app\models\ExpensesSearch $expensessearchModel */
/** @var app\models\Expenses $expenses */
/** @var yii\data\ActiveDataProvider $expensesdataProvider */
/** @var yii\data\ActiveDataProvider $pagination */


$this->title = 'LIST OF ALL DELETED EXPENSE(s)';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="expense(s)category-deleted">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $expensesdataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'quantity',
            'unit_price',
            'expensedate',
            [
                'header' => 'Actions',
                'format' => 'raw',
                'value' => function ( $expenses) {
                    $buttons=Html::a( 'RETURN THIS EXPENSE', ['/expenses/reversal', 'id' =>  $expenses ->id,],
                        [
                            'title' => 'Return this Expense(s)',
                            'class' => 'btn btn-edit',
                            'data-method'  => 'POST',
                            'data-params'  => ['id' => $expenses->id ],]);

                    $buttons.=Html::a('DELETE THIS EXPENSES PERMANENTLY' , ['/expenses/permanently-delete-item', 'id' =>  $expenses->id,],
                        [
                            'title' => 'Delete This Expense(s)',
                            'class' => 'btn btn-danger',
                            'data-confirm' => "Are you sure you want to permanently delete this expense(s)?",
                            'data-method'  => 'POST',
                            'data-params'  => ['id' => $expenses->id ],]);

                    return $buttons;
                },
            ],
        ],
    ]); ?>
</div>

<p>
    <?= Html::a('CLEAR THE RECYCLE BIN', ['hard-delete'], ['class' => 'btn btn-success']) ?>
</p>

</div>

