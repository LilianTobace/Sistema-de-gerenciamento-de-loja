<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CategoriasProdutosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CategoriasProdutosTable Test Case
 */
class CategoriasProdutosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CategoriasProdutosTable
     */
    public $CategoriasProdutos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CategoriasProdutos',
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
        $config = TableRegistry::getTableLocator()->exists('CategoriasProdutos') ? [] : ['className' => CategoriasProdutosTable::class];
        $this->CategoriasProdutos = TableRegistry::getTableLocator()->get('CategoriasProdutos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CategoriasProdutos);

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
