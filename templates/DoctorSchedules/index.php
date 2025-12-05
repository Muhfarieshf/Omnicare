<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\DoctorSchedule> $doctorSchedules
 * @var array $days
 */
?>
<style>
/* ... (Include the same CSS styles from your Appointments/add.php for consistency) ... */
/* Specifically adding the Badge styles here for quick reference */
.status-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.status-active { background: rgba(34, 197, 94, 0.1); color: #22c55e; }
.status-inactive { background: rgba(107, 114, 128, 0.1); color: #6b7280; }

.day-badge {
    background: rgba(0, 102, 204, 0.05);
    color: #0066cc;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.9rem;
}
</style>

<div class="view-container" style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">
    <div class="page-header" style="
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border-radius: 16px;
        padding: 32px;
        margin-bottom: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 4px solid #0066cc;">
        
        <h1 class="page-title" style="font-size: 32px; font-weight: 700; color: #1f1f1f; margin: 0; display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-clock" style="color: #0066cc;"></i>
            <?= __('Schedule Management') ?>
        </h1>
        <?= $this->Html->link(
            '<i class="fas fa-plus"></i> Add New Slot',
            ['action' => 'add'],
            ['class' => 'btn btn-primary', 'escape' => false, 'style' => 'background: linear-gradient(135deg, #0066cc, #004499); color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; box-shadow: 0 4px 16px rgba(0, 102, 204, 0.3);']
        ) ?>
    </div>

    <div class="form-card" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); border-radius: 16px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); padding: 0; overflow: hidden;">
        <div class="table-responsive">
            <table class="table" style="width: 100%; margin-bottom: 0;">
                <thead style="background: rgba(0, 102, 204, 0.02); border-bottom: 1px solid rgba(0,0,0,0.05);">
                    <tr>
                        <?php if ($user->role === 'admin'): ?>
                            <th style="padding: 16px 24px;"><?= $this->Paginator->sort('doctor_id') ?></th>
                        <?php endif; ?>
                        <th style="padding: 16px 24px;"><?= $this->Paginator->sort('day_of_week') ?></th>
                        <th style="padding: 16px 24px;"><?= $this->Paginator->sort('start_time') ?></th>
                        <th style="padding: 16px 24px;"><?= $this->Paginator->sort('end_time') ?></th>
                        <th style="padding: 16px 24px;"><?= $this->Paginator->sort('is_available', 'Status') ?></th>
                        <th style="padding: 16px 24px;" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($doctorSchedules as $schedule): ?>
                    <tr style="border-bottom: 1px solid rgba(0,0,0,0.05);">
                        <?php if ($user->role === 'admin'): ?>
                            <td style="padding: 16px 24px;">
                                <i class="fas fa-user-md" style="color: #666; margin-right: 8px;"></i>
                                <?= $schedule->has('doctor') ? h($schedule->doctor->name) : '' ?>
                            </td>
                        <?php endif; ?>
                        <td style="padding: 16px 24px;">
                            <span class="day-badge"><?= $days[$schedule->day_of_week] ?></span>
                        </td>
                        <td style="padding: 16px 24px; font-weight: 500;">
                            <?= h($schedule->start_time->format('h:i A')) ?>
                        </td>
                        <td style="padding: 16px 24px; font-weight: 500;">
                            <?= h($schedule->end_time->format('h:i A')) ?>
                        </td>
                        <td style="padding: 16px 24px;">
                            <?php if ($schedule->is_available): ?>
                                <span class="status-badge status-active"><i class="fas fa-check"></i> Available</span>
                            <?php else: ?>
                                <span class="status-badge status-inactive"><i class="fas fa-times"></i> Unavailable</span>
                            <?php endif; ?>
                        </td>
                        <td style="padding: 16px 24px;" class="actions">
                            <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $schedule->id], ['escape' => false, 'class' => 'btn-icon', 'style' => 'color: #0066cc; margin-right: 10px;', 'title' => 'Edit']) ?>
                            <?= $this->Form->postLink('<i class="fas fa-trash"></i>', ['action' => 'delete', $schedule->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete this schedule?'), 'class' => 'btn-icon', 'style' => 'color: #dc3545;', 'title' => 'Delete']) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="paginator" style="padding: 20px; text-align: center; border-top: 1px solid rgba(0,0,0,0.05);">
            <ul class="pagination" style="display: inline-flex; list-style: none; gap: 5px;">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
        </div>
    </div>
</div>