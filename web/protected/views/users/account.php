<div class="container narrow">
    <h2>Manage Account</h2>
    <div class="panel panel-default">
        <div class="panel-body">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=> 'user_update'
            )); ?>
                <div class="bg-danger">
                    <?php echo $form->errorSummary($model); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model,'email'); ?>
                    <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => 'application.core')) ?>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model,'first_name'); ?>
                    <?php echo $form->textField($model, 'first_name', array('class' => 'form-control', 'placeholder' => 'John')) ?>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model,'last_name'); ?>
                    <?php echo $form->textField($model, 'last_name', array('class' => 'form-control', 'placeholder' => 'Doe')) ?>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model,'password'); ?>
                    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Update Password')) ?>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model,'ga_secret'); ?>
                    <?php echo $form->textField($model, 'ga_secret', array('class' => 'form-control', 'disabled' => true)) ?>
                    <img src="<?php echo $qr_url ?>" alt="Google Authenticator QR Code"/>
                </div>
                <div class="row ar">
                    <button type="submit" class="btn btn-default">Update</button>
                </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
