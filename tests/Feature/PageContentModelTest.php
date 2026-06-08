<?php
namespace Tests\Feature;
use App\Models\PageContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageContentModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_and_reads_a_section()
    {
        PageContent::create([
            'page' => 'home', 'section_key' => 'hero_heading',
            'label' => 'Hero heading', 'section_group' => 'Hero',
            'type' => 'text', 'value' => 'Hello', 'sort_order' => 1,
        ]);

        $this->assertDatabaseHas('page_contents', [
            'page' => 'home', 'section_key' => 'hero_heading', 'value' => 'Hello',
        ]);
    }

    public function test_value_returns_stored_value_and_default()
    {
        PageContent::create([
            'page' => 'home', 'section_key' => 'hero_heading',
            'label' => 'Hero heading', 'section_group' => 'Hero',
            'type' => 'text', 'value' => 'Stored', 'sort_order' => 1,
        ]);

        $this->assertSame('Stored', PageContent::value('home', 'hero_heading', 'def'));
        $this->assertSame('def', PageContent::value('home', 'missing', 'def'));
    }
}
