<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
 * @var string[]|\Cake\Collection\CollectionInterface $patients
 * @var string[]|\Cake\Collection\CollectionInterface $doctors
 */
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Appointment</h1>
    <?= $this->Html->link('Back to List', ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
</div>

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
                        <?= $this->Form->button('Update Appointment', ['class' => 'btn btn-primary']) ?>
                        <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>