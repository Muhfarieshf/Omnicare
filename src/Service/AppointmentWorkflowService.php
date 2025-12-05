<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\Table\AppointmentsTable;
use App\Model\Table\AppointmentStatusHistoryTable;
use App\Model\Table\UsersTable;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Http\ServerRequest;

/**
 * Appointment Workflow Service
 * 
 * Handles appointment status transitions, approval workflow,
 * and status change audit trail.
 */
class AppointmentWorkflowService
{
    use LocatorAwareTrait;

    protected AppointmentsTable $appointmentsTable;
    protected AppointmentStatusHistoryTable $statusHistoryTable;
    protected UsersTable $usersTable;

    // Valid status transitions
    protected array $statusTransitions = [
        'Scheduled' => ['Confirmed', 'Cancelled', 'Pending Approval'],
        'Confirmed' => ['In Progress', 'Cancelled', 'Pending Approval'],
        'In Progress' => ['Completed', 'Cancelled'],
        
        // FIXED: Added 'Confirmed' so doctors can accept new requests
        'Pending Approval' => ['Cancelled', 'Scheduled', 'Confirmed'], 
        
        'Completed' => [], 
        'Cancelled' => [], 
        'No Show' => [], 
    ];

    protected array $cancellationRequiresApproval = [
        'Confirmed',
        'In Progress'
    ];

    public function __construct()
    {
        $tableLocator = $this->getTableLocator();
        $this->appointmentsTable = $tableLocator->get('Appointments');
        $this->statusHistoryTable = $tableLocator->get('AppointmentStatusHistory');
        $this->usersTable = $tableLocator->get('Users');
    }

    /**
     * Check if a status transition is allowed
     *
     * @param string $fromStatus Current status
     * @param string $toStatus Desired status
     * @param string $userRole User role (admin, doctor, patient)
     * @return bool True if transition is allowed
     */
    public function canTransition(string $fromStatus, string $toStatus, string $userRole): bool
    {
        // Admin can do any transition
        if ($userRole === 'admin') {
            return isset($this->statusTransitions[$fromStatus]) && 
                   in_array($toStatus, $this->statusTransitions[$fromStatus]);
        }

        // Check if transition is in allowed list
        if (!isset($this->statusTransitions[$fromStatus])) {
            return false;
        }

        if (!in_array($toStatus, $this->statusTransitions[$fromStatus])) {
            return false;
        }

        // Role-based restrictions
        $restrictions = $this->getRoleRestrictions($userRole);
        if (isset($restrictions[$fromStatus])) {
            return in_array($toStatus, $restrictions[$fromStatus]);
        }

        return true;
    }

    /**
     * Get allowed transitions for a user role
     *
     * @param string $userRole User role
     * @return array Allowed transitions by role
     */
    protected function getRoleRestrictions(string $userRole): array
    {
        $restrictions = [
            'doctor' => [
                'Scheduled' => ['Confirmed', 'Cancelled'],
                'Confirmed' => ['In Progress', 'Cancelled'],
                'In Progress' => ['Completed'],
                'Pending Approval' => ['Cancelled', 'Confirmed'], 
            ],
            'patient' => [
                // Allow cancelling a Scheduled appointment directly
                'Scheduled' => ['Pending Approval', 'Cancelled'], 
                
                // Allow requesting cancellation for a Confirmed appointment
                'Confirmed' => ['Pending Approval'], 
                
                // FIXED: Allow withdrawing a Pending request (New Appointment)
                'Pending Approval' => ['Cancelled'], 
            ],
        ];

        return $restrictions[$userRole] ?? [];
    }

    /**
     * Get allowed next statuses for an appointment
     *
     * @param int $appointmentId Appointment ID
     * @param string $userRole User role
     * @return array Allowed next statuses
     */
    public function getAllowedTransitions(int $appointmentId, string $userRole): array
    {
        $appointment = $this->appointmentsTable->get($appointmentId);
        $currentStatus = $appointment->status ?? 'Scheduled';

        $allowed = [];
        if (isset($this->statusTransitions[$currentStatus])) {
            foreach ($this->statusTransitions[$currentStatus] as $status) {
                if ($this->canTransition($currentStatus, $status, $userRole)) {
                    $allowed[] = $status;
                }
            }
        }

        return $allowed;
    }

    /**
     * Transition appointment status
     *
     * @param int $appointmentId Appointment ID
     * @param string $newStatus New status
     * @param int $userId User ID making the change
     * @param string|null $notes Additional notes
     * @param ServerRequest|null $request Request object (for IP address)
     * @return array ['success' => bool, 'appointment' => Entity, 'message' => string]
     */
    public function transitionStatus(
        int $appointmentId,
        string $newStatus,
        int $userId,
        ?string $notes = null,
        ?ServerRequest $request = null
    ): array {
        $appointment = $this->appointmentsTable->get($appointmentId, [
            'contain' => ['Patients', 'Doctors']
        ]);

        $oldStatus = $appointment->status ?? 'Scheduled';

        // Get user to check role
        $user = $this->usersTable->get($userId);
        $userRole = $user->role ?? 'patient';

        // Check if transition is allowed
        if (!$this->canTransition($oldStatus, $newStatus, $userRole)) {
            return [
                'success' => false,
                'appointment' => $appointment,
                'message' => "Transition from {$oldStatus} to {$newStatus} is not allowed for {$userRole} role."
            ];
        }

        // Update appointment status and timestamps
        $appointment->status = $newStatus;
        $this->updateStatusTimestamps($appointment, $newStatus, $userId);

        // Save appointment
        if (!$this->appointmentsTable->save($appointment)) {
            return [
                'success' => false,
                'appointment' => $appointment,
                'message' => 'Failed to update appointment status.'
            ];
        }

        // Log status change
        $this->logStatusChange($appointmentId, $oldStatus, $newStatus, $userId, $notes, $request);

        return [
            'success' => true,
            'appointment' => $appointment,
            'message' => "Appointment status changed from {$oldStatus} to {$newStatus}."
        ];
    }

    /**
     * Confirm an appointment
     *
     * @param int $appointmentId Appointment ID
     * @param int $userId User ID
     * @return array Result array
     */
    public function confirm(int $appointmentId, int $userId): array
    {
        return $this->transitionStatus($appointmentId, 'Confirmed', $userId, 'Appointment confirmed');
    }

    /**
     * Start an appointment (mark as In Progress)
     *
     * @param int $appointmentId Appointment ID
     * @param int $userId User ID
     * @return array Result array
     */
    public function start(int $appointmentId, int $userId): array
    {
        return $this->transitionStatus($appointmentId, 'In Progress', $userId, 'Appointment started');
    }

    /**
     * Complete an appointment
     *
     * @param int $appointmentId Appointment ID
     * @param int $userId User ID
     * @return array Result array
     */
    public function complete(int $appointmentId, int $userId): array
    {
        return $this->transitionStatus($appointmentId, 'Completed', $userId, 'Appointment completed');
    }

    /**
     * Request cancellation (creates Pending Approval status)
     *
     * @param int $appointmentId Appointment ID
     * @param int $userId User ID
     * @param string|null $reason Cancellation reason
     * @return array Result array
     */
    public function requestCancellation(int $appointmentId, int $userId, ?string $reason = null): array
    {
        $appointment = $this->appointmentsTable->get($appointmentId);

        // Check if cancellation requires approval
        if (in_array($appointment->status, $this->cancellationRequiresApproval)) {
            $appointment->requires_approval = true;
            $appointment->cancellation_reason = $reason;
            $this->appointmentsTable->save($appointment);

            return $this->transitionStatus(
                $appointmentId,
                'Pending Approval',
                $userId,
                "Cancellation requested. Reason: {$reason}"
            );
        }

        // Direct cancellation (no approval needed)
        return $this->cancel($appointmentId, $userId, $reason);
    }

    /**
     * Cancel an appointment
     *
     * @param int $appointmentId Appointment ID
     * @param int $userId User ID
     * @param string|null $reason Cancellation reason
     * @return array Result array
     */
    public function cancel(int $appointmentId, int $userId, ?string $reason = null): array
    {
        $appointment = $this->appointmentsTable->get($appointmentId);
        $appointment->cancelled_by = $userId;
        $appointment->cancellation_reason = $reason;
        $this->appointmentsTable->save($appointment);

        return $this->transitionStatus(
            $appointmentId,
            'Cancelled',
            $userId,
            "Appointment cancelled. Reason: {$reason}"
        );
    }

    /**
     * Approve cancellation request
     *
     * @param int $appointmentId Appointment ID
     * @param int $userId User ID (approver)
     * @return array Result array
     */
    public function approveCancellation(int $appointmentId, int $userId): array
    {
        $appointment = $this->appointmentsTable->get($appointmentId);

        if ($appointment->status !== 'Pending Approval') {
            return [
                'success' => false,
                'appointment' => $appointment,
                'message' => 'Appointment is not pending approval.'
            ];
        }

        $appointment->approved_by = $userId;
        $appointment->approved_at = \Cake\I18n\FrozenTime::now();
        $this->appointmentsTable->save($appointment);

        return $this->cancel($appointmentId, $userId, $appointment->cancellation_reason);
    }

    /**
     * Reject cancellation request (revert to previous status)
     *
     * @param int $appointmentId Appointment ID
     * @param int $userId User ID
     * @param string|null $reason Rejection reason
     * @return array Result array
     */
    public function rejectCancellation(int $appointmentId, int $userId, ?string $reason = null): array
    {
        $appointment = $this->appointmentsTable->get($appointmentId);

        if ($appointment->status !== 'Pending Approval') {
            return [
                'success' => false,
                'appointment' => $appointment,
                'message' => 'Appointment is not pending approval.'
            ];
        }

        // Get previous status from history
        $history = $this->statusHistoryTable->find()
            ->where(['appointment_id' => $appointmentId])
            ->order(['changed_at' => 'DESC'])
            ->limit(2)
            ->toArray();

        $previousStatus = 'Scheduled';
        if (count($history) >= 2) {
            $previousStatus = $history[1]->old_status ?? 'Scheduled';
        }

        $appointment->requires_approval = false;
        $appointment->cancellation_reason = null;
        $this->appointmentsTable->save($appointment);

        return $this->transitionStatus(
            $appointmentId,
            $previousStatus,
            $userId,
            "Cancellation request rejected. Reason: {$reason}"
        );
    }

    /**
     * Check if cancellation requires approval
     *
     * @param int $appointmentId Appointment ID
     * @return bool True if approval is required
     */
    public function requiresApproval(int $appointmentId): bool
    {
        $appointment = $this->appointmentsTable->get($appointmentId);
        return in_array($appointment->status, $this->cancellationRequiresApproval);
    }

    /**
     * Update status-specific timestamps
     *
     * @param \App\Model\Entity\Appointment $appointment Appointment entity
     * @param string $newStatus New status
     * @param int $userId User ID
     * @return void
     */
    protected function updateStatusTimestamps($appointment, string $newStatus, int $userId): void
    {
        $now = \Cake\I18n\FrozenTime::now();

        switch ($newStatus) {
            case 'Confirmed':
                $appointment->confirmed_at = $now;
                break;
            case 'In Progress':
                $appointment->started_at = $now;
                break;
            case 'Completed':
                $appointment->completed_at = $now;
                break;
            case 'Cancelled':
                $appointment->cancelled_at = $now;
                $appointment->cancelled_by = $userId;
                break;
        }
    }

    /**
     * Log status change to history
     *
     * @param int $appointmentId Appointment ID
     * @param string|null $oldStatus Old status
     * @param string $newStatus New status
     * @param int $userId User ID
     * @param string|null $notes Additional notes
     * @param ServerRequest|null $request Request object
     * @return void
     */
    protected function logStatusChange(
        int $appointmentId,
        ?string $oldStatus,
        string $newStatus,
        int $userId,
        ?string $notes = null,
        ?ServerRequest $request = null
    ): void {
        $history = $this->statusHistoryTable->newEntity([
            'appointment_id' => $appointmentId,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'changed_by' => $userId,
            'notes' => $notes,
            'ip_address' => $request ? $request->getAttribute('client_ip') : null
        ]);

        $this->statusHistoryTable->save($history);
    }

    /**
     * Get status history for an appointment
     *
     * @param int $appointmentId Appointment ID
     * @return array Status history entries
     */
    public function getStatusHistory(int $appointmentId): array
    {
        return $this->statusHistoryTable->find('forAppointment', ['appointment_id' => $appointmentId])
            ->contain(['ChangedByUser'])
            ->toArray();
    }
}




