<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Expensescategory $expensescategory */
/** @var yii\widgets\ActiveForm $form */
?>
<?php if (Yii::$app->session->hasFlash('EXPENSE(s) CATEGORY UPDATE')): ?>

    <div class="alert alert-success">
        'EXPENSE(s) CATEGORY RECORD WAS UPDATED SUCCESSFULLY'
    </div>

<?php endif; ?>

<div class="new-expense">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($expensescategory, 'description')->textarea(['rows' => 2]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>