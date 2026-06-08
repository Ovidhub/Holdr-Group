<?php
namespace Tests\Feature;
use App\Models\PageContent;
use Database\Seeders\PageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageContentSeederTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        PageContent::flushCache();
    }

    public function test_seeder_inserts_sections_and_is_idempotent()
    {
        (new PageContentSeeder())->run();
        $countAfterFirst = PageContent::count();

        $this->assertSame(76, $countAfterFirst);
        $this->assertSame('Move Money Across the World in Real Time',
            PageContent::value('home', 'hero_heading'));
        $this->assertSame('About Mortil Holders',
            PageContent::value('about', 'header_title'));
        $this->assertSame('Contact Us',
            PageContent::value('contact', 'header_title'));

        // Running again must not duplicate rows.
        (new PageContentSeeder())->run();
        $this->assertSame($countAfterFirst, PageContent::count());
    }
}
