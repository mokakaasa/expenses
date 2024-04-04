<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;



/** @var yii\web\View $this */
/** @var app\models\Expenses $expenses */
/** @var app\models\Expensescategory $expensescategories */
/** @var yii\widgets\ActiveForm $form */
?>
<?php if (Yii::$app->session->hasFlash('EXPENSES')):?>

    <div class="alert alert-success">
        'A NEW EXPENSE RECORD WAS CREATED SUCCESSFULLY'
    </div>

<?php endif; ?>

<div class="new-expense">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($expenses, 'expense_category_id')->dropDownList(
            ArrayHelper::map(\app\models\Expensescategory::find()->all(),'id','name'),
        ['prompt'=>"Expense's Name"]
    ) ?>
    <?= $form->field($expenses, 'unit_price')->textInput(['type' => 'number']) ?>
    <?= $form->field($expenses, 'quantity')->textInput(['type' => 'number']) ?>
    <?= $form->field($expenses, 'amount')->textInput(['type' => 'number']) ?>
    <?= $form->field($expenses, 'expensedate')->widget(\yii\jui\DatePicker::class, []) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
