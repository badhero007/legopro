<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => [
        'class' => 'form-horizontal',
        'enctype' => 'multipart/form-data'
    ],
]) ?>

<?= $form->field($model, 'password_hash')->passwordInput() ?>

<?= $form->field($model, 'username')->textInput()->hint('Please enter your name')->label('Name') ?>

<?= $form->field($model, 'email')->input('email') ?>

<?= $form->field($model, 'logo')->fileInput(['multiple'=>'multiple']); ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

<?php ActiveForm::end() ?>

<script>
    $(function(){
        $('#user-logo').change(function(){
            console.log(this.files);
        })
    })
</script>