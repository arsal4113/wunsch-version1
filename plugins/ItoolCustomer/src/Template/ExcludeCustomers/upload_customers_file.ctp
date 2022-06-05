<div class="container wrapper border-bottom white-bg page-heading" style="width: 100%">
    <div class="col-sm-12">
        <h2>Upload Customer Exclude File</h2>
    </div>
</div>
<div style="height: 20px;"></div>
<div class="container wrapper border-bottom white-bg page-heading" style="width: 100%;">
    <div style="height: 20px;"></div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-11">
            <h3>Bitte laden Sie eine CSV Datei hoch!</h3>
        </div>
    </div>
    <div style="height: 20px;"></div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-11">

            <?= $this->Form->create('', ['url' => ['plugin' => 'ItoolCustomer', 'controller' => 'ExcludeCustomers', 'action' => 'uploadCustomersFile'], 'type' => 'file', 'class' => 'form-horizontal upload_form']); ?>
            <div class="form-group form_height">
                <label class="control-label col-sm-2"><h3>Datei hochladen</h3></label>
                <div class="col-sm-3">
                    <?= $this->Form->file('file', ['label' => __('CSV File'), 'class' => 'form-control file_upload', 'empty' => 'hochladen', 'placeholder' => 'upload']); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-1">
                    <?= $this->Form->button(__('Cancel'), ['class' => 'btn btn-danger', 'name' => "csv_file", 'value' => 'cancel' ,'required' => false]); ?>
                </div>
                <div class="col-sm-1 ">
                    <?= $this->Form->button(__('Upload'), ['class' => 'btn btn-primary', 'name' => "csv_file", 'value' => 'submit', 'required' => true]); ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>

</div>
