<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Expensescategory $expensescategory */
/** @var yii\widgets\ActiveForm $form */
?>
<?php if (Yii::$app->session->hasFlash('EXPENSE(s) CATEGORY')):?>

    <div class="alert alert-success">
        'A NEW EXPENSE(s) CATEGORY RECORD WAS CREATED SUCCESSFULLY'
    </div>

<?php endif; ?>

<div class="expensescategory">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($expensescategory, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($expensescategory, 'description')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>