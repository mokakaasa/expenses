<?php

use app\models\Expensescategory;
use app\models\ExpensescategorySearch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\widgets\LinkPager;
use yii\data\Pagination;

/** @var yii\web\View $this */
/** @var app\models\ExpensescategorySearch $expensescategorysearch */
/** @var app\models\Expensescategory $expensescategory */
/** @var yii\data\ActiveDataProvider $expensescategorydataProvider */
/** @var yii\data\ActiveDataProvider $pagination */


$this->title = 'LIST OF ALL DELETED EXPENSE(s) CATEGORIES';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="expense(s)category-deleted">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $expensescategorydataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'description',
            [
                'header' => 'Actions',
                'format' => 'raw',
                'value' => function ($expensescategory ) {
                    $buttons=Html::a( 'RETURN PRODUCT', ['/pos/product', 'id' => $expensescategory ->id,],
                        [
                            'title' => 'Update my To_Do List',
                            'class' => 'btn btn-edit',
                            'data-method'  => 'POST',
                            'data-params'  => ['id' => $expensescategory ->id ],]);

                    $buttons.=Html::a('DELETE PRODUCT PERMANENTLY' , ['/expensescategory/permanently-delete-item', 'id' => $expensescategory ->id,],
                        [
                            'title' => 'Delete Product',
                            'class' => 'btn btn-danger',
                            'data-confirm' => "Are you sure you want to permanently delete this task?",
                            'data-method'  => 'POST',
                            'data-params'  => ['id' =>$expensescategory ->id ],]);

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

