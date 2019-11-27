<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProdutosVendasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProdutosVendasTable Test Case
 */
class ProdutosVendasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProdutosVendasTable
     */
    public $ProdutosVendas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProdutosVendas',
        'app.Produtos',
        'app.Vendas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProdutosVendas') ? [] : ['className' => ProdutosVendasTable::class];
        $this->ProdutosVendas = TableRegistry::getTableLocator()->get('ProdutosVendas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProdutosVendas);

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
