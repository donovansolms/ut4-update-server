<div class="holder medium">
	<?php if (Yii::app()->user->hasFlash('ok')): ?>
		<div class="alert-success errorSummary">
			<?php echo Yii::app()->user->getFlash('ok'); ?>
		</div>
	<?php endif; ?>
	<div class="title">
		<h1>Login</h1>
	</div>
	<div class="login-form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
			'enableClientValidation'=>false,
			'clientOptions'=>array(
				'validateOnSubmit'=>false,
			),
			'htmlOptions' => array(
					'onkeypress' => 'if(event.keyCode == 13){ $(this).submit(); }',
			),
		)); ?>
			<div class="form-group">
				<label for="LoginForm_username" class="sr-only">Email address</label>
				<?php echo $form->emailField($model, 'username', array('class' => 'form-control', 'placeholder' => 'user@example.com')); ?>
			</div>
			<div class="form-group">
				<label for="LoginForm_password" class="sr-only">Password</label>
				<?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Password')); ?>
			</div>
			<div class="form-group">
				<label for="LoginForm_ga_code" class="sr-only">Google Authenticator Code</label>
				<?php echo $form->textField($model, 'ga_code', array('class' => 'form-control', 'placeholder' => 'Google Authenticator Code')); ?><br />
			</div>
			<button type="submit" class="btn btn-default">Login</button>
			<div class="error">
				<?php echo $form->errorSummary($model, ""); ?>
			</div>
		<?php $this->endWidget(); ?>
	</div>
</div>
