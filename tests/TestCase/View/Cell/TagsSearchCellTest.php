<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Cell;

use App\View\Cell\TagsSearchCell;
use Cake\TestSuite\TestCase;

/**
 * App\View\Cell\TagsSearchCell Test Case
 */
class TagsSearchCellTest extends TestCase
{
    /**
     * Request mock
     *
     * @var \Cake\Http\ServerRequest|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $request;

    /**
     * Response mock
     *
     * @var \Cake\Http\Response|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $response;

    /**
     * Test subject
     *
     * @var \App\View\Cell\TagsSearchCell
     */
    protected $TagsSearch;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->request = $this->getMockBuilder('Cake\Http\ServerRequest')->getMock();
        $this->response = $this->getMockBuilder('Cake\Http\Response')->getMock();
        $this->TagsSearch = new TagsSearchCell($this->request, $this->response);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TagsSearch);

        parent::tearDown();
    }

    /**
     * Test display method
     *
     * @return void
     * @uses \App\View\Cell\TagsSearchCell::display()
     */
    public function testDisplay(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
