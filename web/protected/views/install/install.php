<div class="holder medium top">
	<div class="title">
		<h1>Installation</h1>
	</div>
    <div class="installer instructions">
        <ol>
            <li>Please enter a new admin password below</li>
            <li>Scan the Authenticator barcode or enter the secret key</li>
            <li>Enter the generated code</li>
        </ol>
    </div>
	<div class="install-form">
        <?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'install-form',
			'enableClientValidation'=>false,
			'clientOptions'=>array(
				'validateOnSubmit'=>false,
			),
			'htmlOptions' => array(
					'onkeypress' => 'if(event.keyCode == 13){ $(this).submit(); }',
			),
		)); ?>
			<div class="form-group">
				<div class="alert-danger">
					<?php echo $form->errorSummary($model, ""); ?>
				</div>
			</div>
			<?php echo $form->hiddenField($model, 'ga_secret') ?>
			<div class="form-group">
				<label for="InstallForm_password" class="sr-only">Password</label>
				<?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'New Admin Password')); ?>
			</div>
			<div class="form-group">
				<?php echo CHtml::image($qr) ?>
			</div>
			<div class="form-group">
				<b>Secret:</b> <?php echo $model->ga_secret ?>
			</div>
			<div class="form-group">
				<label for="InstallForm_ga_code" class="sr-only">Google Authenticator Code</label>
				<?php echo $form->textField($model, 'ga_code', array('class' => 'form-control', 'placeholder' => 'Google Authenticator Code')); ?><br />
			</div>
			<button type="submit" class="btn btn-default">Install</button>
		<?php $this->endWidget(); ?>
	</div>
</div>
