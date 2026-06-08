<?php
namespace Tests\Feature;
use App\Models\Settings;
use Database\Seeders\PageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactPageContentRenderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        \App\Models\PageContent::flushCache();
        Settings::forceCreate([
            'id' => 1, 'site_name' => 'Mortil Holders',
            'site_address' => 'https://mortilholders.online',
            'trade_mode' => 'on', 'weekend_trade' => 'on',
        ]);
        (new PageContentSeeder())->run();
    }

    public function test_contact_shows_seeded_content()
    {
        $this->get('/contact')->assertOk()
            ->assertSee('Contact Us')
            ->assertSee('info@mortilholders.online')
            ->assertSee('love to hear from you');
    }
}
