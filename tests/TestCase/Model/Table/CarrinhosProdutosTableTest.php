<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CarrinhosProdutosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CarrinhosProdutosTable Test Case
 */
class CarrinhosProdutosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CarrinhosProdutosTable
     */
    public $CarrinhosProdutos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CarrinhosProdutos',
        'app.Vendas',
        'app.Produtos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CarrinhosProdutos') ? [] : ['className' => CarrinhosProdutosTable::class];
        $this->CarrinhosProdutos = TableRegistry::getTableLocator()->get('CarrinhosProdutos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CarrinhosProdutos);

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
