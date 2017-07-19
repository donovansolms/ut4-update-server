<div class="container narrow">
    <h2>Create Update</h2>
    <div class="panel panel-default">
        <div class="panel-body">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=> 'update_create',
                'htmlOptions' => array('enctype' => 'multipart/form-data')
            )); ?>
                <div class="bg-danger">
                    <?php echo $form->errorSummary($model); ?>
                </div>
                <div class="form-group">
                    <label for="trackInput">Track</label>
                    <select class="form-control" id="trackInput" name="Updates[track]">
                        <option value="beta">Beta</option>
                        <option value="stable">Stable</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="appId">Application ID</label>
                    <input type="text" class="form-control" id="appId" placeholder="application.core" name="Updates[app_id]">
                </div>
                <label>Version</label>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-2" id="version">
                            <input type="text" class="form-control" placeholder="Major" name="Updates_major">
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" placeholder="Minor" name="Updates_minor">
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" placeholder="Patch" name="Updates_patch">
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" placeholder="Build" name="Updates_build">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="filename">Filename</label>
                    <input type="text" class="form-control" id="filename" placeholder="Application.tar.gz" name="Updates[filename]">
                </div>
                <div class="form-group">
                    <label for="download_location">Download Location</label>
                    <input type="text" class="form-control" id="download_location" placeholder="http://www.example.com/download/Application.tar.gz" name="Updates[download_location]">
                </div>
                <div class="form-group">
                    <label for="size_in_bytes">Size in Bytes</label>
                    <input type="text" class="form-control" id="size_in_bytes" placeholder="102 496" name="Updates[size_in_bytes]">
                </div>
                <div class="form-group">
                    <label for="sha256_hash">SHA 256 Hash</label>
                    <input type="text" class="form-control" id="sha256_hash" placeholder="84acea72bf10939d07904e1d0e6d4985e7e..." name="Updates[sha256_hash]">
                </div>
                <button type="submit" class="btn btn-default">Publish</button>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
