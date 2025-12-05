<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DoctorSchedule $doctorSchedule
 * @var \Cake\Collection\CollectionInterface|string[] $doctors
 * @var array $days
 * @var \App\Model\Entity\User $user
 */
?>
<style>
.form-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); border-radius: 16px; padding: 40px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); }
.form-group { margin-bottom: 24px; }
.form-control { width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ddd; }
.btn-primary { background: linear-gradient(135deg, #0066cc, #004499); color: white; padding: 12px 24px; border: none; border-radius: 8px; }
</style>

<div class="form-container" style="max-width: 800px; margin: 0 auto; padding: 40px 20px;">
    <div class="page-header" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <h1 class="page-title" style="font-size: 28px; font-weight: 700; color: #1f1f1f;">
            <i class="fas fa-calendar-plus" style="color: #0066cc; margin-right: 10px;"></i>
            <?= __('Add Schedule Slot') ?>
        </h1>
        <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline', 'escape' => false, 'style' => 'border: 1px solid #0066cc; color: #0066cc; padding: 8px 16px; border-radius: 8px; text-decoration: none;']) ?>
    </div>

    <div class="form-card">
        <?= $this->Form->create($doctorSchedule) ?>
        
        <?php if ($user->role === 'admin'): ?>
        <div class="form-group">
            <label style="font-weight: 600; margin-bottom: 8px; display: block;">Doctor</label>
            <?= $this->Form->control('doctor_id', ['options' => $doctors, 'class' => 'form-control', 'label' => false]) ?>
        </div>
        <?php endif; ?>

        <div class="form-group">
            <label style="font-weight: 600; margin-bottom: 8px; display: block;">Day of Week</label>
            <?= $this->Form->control('day_of_week', ['options' => $days, 'class' => 'form-control', 'label' => false]) ?>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label style="font-weight: 600; margin-bottom: 8px; display: block;">Start Time</label>
                <?= $this->Form->control('start_time', [
                    'type' => 'time', 
                    'class' => 'form-control', 
                    'label' => false, 
                    'step' => 900
                ]) ?>
            </div>
            <div class="form-group">
                <label style="font-weight: 600; margin-bottom: 8px; display: block;">End Time</label>
                <?= $this->Form->control('end_time', [
                    'type' => 'time', 
                    'class' => 'form-control', 
                    'label' => false, 
                    'step' => 900
                ]) ?>
            </div>
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <?= $this->Form->checkbox('is_available', ['checked' => true]) ?>
                <span style="font-weight: 600;">Set as Available</span>
            </label>
        </div>

        <div class="form-group">
            <label style="font-weight: 600; margin-bottom: 8px; display: block;">Notes (Optional)</label>
            <?= $this->Form->control('notes', ['type' => 'textarea', 'class' => 'form-control', 'rows' => 3, 'label' => false]) ?>
        </div>

        <div style="margin-top: 30px; text-align: right;">
             <?= $this->Form->button(__('Save Schedule'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>