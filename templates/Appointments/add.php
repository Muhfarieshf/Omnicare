<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add Appointment</h1>
    <?= $this->Html->link('Back to List', ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
</div>

<?= $this->Form->create(null) ?>
<?= $this->Form->control('test', ['value' => 'test']) ?>
<?= $this->Form->button('Test') ?>
<?= $this->Form->end() ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <?= $this->Form->create($appointment) ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?= $this->Form->control('patient_id', [
                                    'options' => $patients,
                                    'class' => 'form-select',
                                    'empty' => 'Select Patient'
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?= $this->Form->control('doctor_id', [
                                    'options' => $doctors,
                                    'class' => 'form-select',
                                    'empty' => 'Select Doctor'
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?= $this->Form->control('appointment_date', [
                                    'type' => 'date',
                                    'class' => 'form-control'
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?= $this->Form->control('appointment_time', [
                                    'type' => 'time',
                                    'class' => 'form-control'
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <?= $this->Form->control('status', [
                            'type' => 'select',
                            'options' => [
                                'Scheduled' => 'Scheduled',
                                'Completed' => 'Completed',
                                'Cancelled' => 'Cancelled',
                                'No Show' => 'No Show'
                            ],
                            'class' => 'form-select'
                        ]) ?>
                    </div>
                    <div class="mb-3">
                        <?= $this->Form->control('remarks', [
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'rows' => 3
                        ]) ?>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <?= $this->Form->button('Save Appointment', ['class' => 'btn btn-primary']) ?>
                        <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>