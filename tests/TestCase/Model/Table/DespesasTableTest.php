<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DespesasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DespesasTable Test Case
 */
class DespesasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DespesasTable
     */
    public $Despesas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Despesas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Despesas') ? [] : ['className' => DespesasTable::class];
        $this->Despesas = TableRegistry::getTableLocator()->get('Despesas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Despesas);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
