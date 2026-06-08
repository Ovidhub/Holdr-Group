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
            ->assertSee('Smarter Banking for Every Business')
            ->assertSee('Built for the Way Businesses Actually Work')
            ->assertSee('Manage Your Business Finances on the Move')
            ->assertSee('Trusted by 500K+ businesses worldwide');
    }
}
