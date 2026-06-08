<?php
namespace Tests\Feature;
use App\Models\PageContent;
use App\Models\Settings;
use Database\Seeders\PageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageContentRenderTest extends TestCase
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

    public function test_home_shows_seeded_hero_and_reflects_edits()
    {
        $this->get('/')->assertOk()
            ->assertSee('Move Money Across the World in Real Time')
            ->assertDontSee('Transfer Money Across The World In Real time');

        PageContent::where('page', 'home')->where('section_key', 'hero_heading')
            ->first()->update(['value' => 'Edited Hero']);

        $this->get('/')->assertSee('Edited Hero');
    }
}
