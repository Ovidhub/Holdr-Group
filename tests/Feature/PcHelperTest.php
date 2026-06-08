<?php
namespace Tests\Feature;
use App\Models\PageContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PcHelperTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        PageContent::flushCache();
    }

    public function test_pc_returns_value_and_default()
    {
        PageContent::create([
            'page' => 'home', 'section_key' => 'hero_heading',
            'label' => 'Hero heading', 'section_group' => 'Hero',
            'type' => 'text', 'value' => 'Welcome', 'sort_order' => 1,
        ]);

        $this->assertSame('Welcome', pc('home', 'hero_heading'));
        $this->assertSame('fallback', pc('home', 'nope', 'fallback'));
    }
}
