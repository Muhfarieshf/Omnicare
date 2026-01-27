<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddPasswordResetFieldsToUsers extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('users');
        $table->addColumn('reset_token', 'string', [
            'limit' => 100,
            'null' => true,
            'default' => null,
            'after' => 'status'
        ]);
        $table->addColumn('token_expiry', 'datetime', [
            'null' => true,
            'default' => null,
            'after' => 'reset_token'
        ]);
        $table->update();
    }
}
