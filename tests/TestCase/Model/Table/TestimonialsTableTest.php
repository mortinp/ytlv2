<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TestimonialsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TestimonialsTable Test Case
 */
class TestimonialsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TestimonialsTable
     */
    protected $Testimonials;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Testimonials',
        'app.Conversations',
        'app.Drivers',
        'app.ConversationsMeta',
        'app.TestimonialsReplies',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Testimonials') ? [] : ['className' => TestimonialsTable::class];
        $this->Testimonials = TableRegistry::getTableLocator()->get('Testimonials', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Testimonials);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
