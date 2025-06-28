<div class="container-fluid d-flex justify-content-center" style="max-width:1680px;">
    <div class="row w-100 justify-content-left">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 mb-0 text-left">Add Appointment</h1>
                <?= $this->Html->link('Back to List', ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
            </div>
            <div class="card">
                <div class="card-body">
                <?= $this->Form->create($appointment) ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?php if (isset($currentUser) && $currentUser->role === 'patient' && !empty($currentUser->patient_id)): ?>
                                    <?= $this->Form->hidden('patient_id', ['value' => $currentUser->patient_id]) ?>
                                    <div class="form-control-plaintext"><strong>Patient:</strong> <?= h($currentUser->username) ?></div>
                                <?php else: ?>
                                    <?= $this->Form->control('patient_id', [
                                        'options' => $patients,
                                        'class' => 'form-select',
                                        'empty' => 'Select Patient'
                                    ]) ?>
                                <?php endif; ?>
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