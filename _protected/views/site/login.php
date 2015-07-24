<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-box">
      <div class="login-logo">
        <a href="#"><b>OpenPests</b>Trap</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg"><?= Html::encode($this->title) ?></p>
    
        <p><?= Yii::t('app', 'Please fill out the following fields to login:') ?></p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

          <div class="form-group has-feedback">
            
        <?php //-- use email or username field depending on model scenario --// ?>
        <?php if ($model->scenario === 'lwe'): ?>
            <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'placeholder'=>'Email'])->label(false); ?>
        
        <?php else: ?>
            <?= $form->field($model, 'username')->textInput(['class' => 'form-control' ,'placeholder'=>'Username'])->label(false); ?>
			
        <?php endif ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
			<?= $form->field($model, 'password')->passwordInput(['class' => 'form-control' ,'placeholder'=>'Password'])->label(false); ?>
            
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
					
					<?= $form->field($model, 'rememberMe')->checkbox() ?>
			   </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary btn-block btn-', 'name' => 'login-button']) ?>
            </div><!-- /.col -->
          </div>
        </form>


        <?= Html::a(Yii::t('app', 'reset it'), ['site/request-password-reset']) ?>.<br>
       <?= Html::a(Yii::t('app', 'Register'), ['site/register']) ?>.

      </div><!-- /.login-box-body -->
    </div>



       

	  