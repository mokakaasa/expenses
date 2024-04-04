<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/** @var app\models\Expensescategory $expensescategory */


$this->title =$expensescategory->name;
$this->params['breadcrumbs'][] = ['label' => 'List of All Expense(s)  Category', 'url' => ['expensescategory']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
echo "Expense's Category ID:".$expensescategory->id.'<br>';
echo "Expense's Category Description:".$expensescategory->description.'<br>';
?>
