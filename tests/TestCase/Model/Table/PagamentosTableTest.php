<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PagamentosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PagamentosTable Test Case
 */
class PagamentosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PagamentosTable
     */
    public $Pagamentos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Pagamentos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Pagamentos') ? [] : ['className' => PagamentosTable::class];
        $this->Pagamentos = TableRegistry::getTableLocator()->get('Pagamentos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pagamentos);

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
