<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DoctorsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DoctorsTable Test Case
 */
class DoctorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DoctorsTable
     */
    protected $Doctors;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Doctors',
        'app.Departments',
        'app.Appointments',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Doctors') ? [] : ['className' => DoctorsTable::class];
        $this->Doctors = $this->getTableLocator()->get('Doctors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Doctors);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DoctorsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DoctorsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
