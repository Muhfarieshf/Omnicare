<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PatientsFixture
 */
class PatientsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'gender' => 'Lorem ip',
                'dob' => '2025-06-26',
                'contact_number' => 'Lorem ipsum d',
                'email' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor ',
                'created_at' => 1750916363,
                'updated_at' => 1750916363,
            ],
        ];
        parent::init();
    }
}
