
<div class="container-fluid d-flex justify-content-center" style="max-width:1680px;">
    <div class="row w-100 justify-content-left">
        <div class="col-md-10">
            <div class="users view content py-4">
                <h3 class="mb-4 text-left"><?= h($user->username) ?></h3>
                <table class="table table-bordered table-striped mb-4">
                    <tr>
                        <th><?= __('Username') ?></th>
                        <td><?= h($user->username) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Role') ?></th>
                        <td><?= h($user->role) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Status') ?></th>
                        <td><?= h($user->status) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Email') ?></th>
                        <td><?= h($user->email ?? 'N/A') ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($user->id) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created At') ?></th>
                        <td><?= h($user->created_at) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Updated At') ?></th>
                        <td><?= h($user->updated_at) ?></td>
                    </tr>
                </table>
                <div class="d-flex mb-4">
                    <?php if (isset($currentUser) && $currentUser->role !== 'patient' && $currentUser->role !== 'user'): ?>
                        <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'btn btn-primary me-2']) ?>
                        <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-danger me-2']) ?>
                        <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'btn btn-secondary me-2']) ?>
                        <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'btn btn-success']) ?>
                    <?php elseif (isset($currentUser) && $currentUser->role === 'user' && isset($currentUser->user_id) && $user->id == $currentUser->user_id): ?>
                        <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'btn btn-primary']) ?>
                    <?php elseif (isset($currentUser) && $currentUser->role !== 'user'): ?>
                        <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
                    <?php endif; ?>
                </div>
                <!-- Related section can be added here if needed -->
            </div>
        </div>
    </div>
</div>