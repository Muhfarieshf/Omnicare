<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DoctorsFixture
 */
class DoctorsFixture extends TestFixture
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
                'department_id' => 1,
                'status' => 'Lorem ipsum dolor ',
                'created_at' => 1750916380,
                'updated_at' => 1750916380,
            ],
        ];
        parent::init();
    }
}
