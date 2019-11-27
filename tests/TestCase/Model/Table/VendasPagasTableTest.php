<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VendasPagasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VendasPagasTable Test Case
 */
class VendasPagasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VendasPagasTable
     */
    public $VendasPagas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.VendasPagas',
        'app.Vendas',
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
        $config = TableRegistry::getTableLocator()->exists('VendasPagas') ? [] : ['className' => VendasPagasTable::class];
        $this->VendasPagas = TableRegistry::getTableLocator()->get('VendasPagas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VendasPagas);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
