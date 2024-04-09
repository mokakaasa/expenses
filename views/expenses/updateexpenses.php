<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Expenses $expenses */
/** @var yii\widgets\ActiveForm $form */
?>
<?php if (Yii::$app->session->hasFlash('EXPENSE(s) UPDATE')): ?>

    <div class="alert alert-success">
        'EXPENSE(s) RECORD WAS UPDATED SUCCESSFULLY'
    </div>

<?php endif; ?>

<div class="update-expense">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($expenses, 'unit_price')->textInput(['type' => 'number']) ?>
    <?= $form->field($expenses, 'quantity')->textInput(['type' => 'number']) ?>
    <?= $form->field($expenses, 'expensedate')->widget(\yii\jui\DatePicker::class, []) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>