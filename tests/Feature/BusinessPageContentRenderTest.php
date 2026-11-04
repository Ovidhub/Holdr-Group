<?php
namespace Tests\Feature;
use App\Models\PageContent;
use App\Models\Settings;
use Database\Seeders\PageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BusinessPageContentRenderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        PageContent::flushCache();
        Settings::forceCreate([
            'id' => 1, 'site_name' => 'Mortil Holders',
            'site_address' => 'https://mortilholders.online',
            'trade_mode' => 'on', 'weekend_trade' => 'on',
        ]);
        (new PageContentSeeder())->run();
    }

    public function test_business_shows_seeded_content()
    {
        $this->get('/business')->assertOk()
            ->assertSee('Enterprise Treasury & Commercial Banking Built for Scale')
            ->assertSee('Institutional Financial Infrastructure for Modern Enterprises')
            ->assertSee('Command Your Corporate Treasury From Anywhere')
            ->assertSee('Trusted by 550K+ corporate and commercial entities worldwide');
    }
}
