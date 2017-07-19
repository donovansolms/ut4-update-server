<div class="container-fluid">
    <h2>Current Updates</h2>
    <?php if (Yii::app()->user->hasFlash('ok')): ?>
        <p class="bg-success">
            <?php echo Yii::app()->user->getFlash('ok') ?>
        </p>
    <?php endif ?>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
                array(
                    'name' => 'app_id',
                    'type' => 'raw',
                    'value' => '$data->app_id',
                ),
                array(
                    'name' => 'track',
                    'type' => 'raw',
                    'value' => '$data->track',
                ),
                array(
                    'name' => 'version',
                    'type' => 'raw',
                    'value' => '$data->version',
                ),
                array(
                    'name' => 'upgrade_count',
                    'type' => 'raw',
                    'value' => '$data->upgrade_count',
                ),
                array(
                    'name' => 'date_created',
                    'type' => 'raw',
                    'value' => 'date("j M Y H:i", strtotime($data->date_created))',
                ),
                array(
                        'class'=>'CButtonColumn',
                        'template'=>'{delete}',
                ),
            ),
    ));
    ?>

</div>
