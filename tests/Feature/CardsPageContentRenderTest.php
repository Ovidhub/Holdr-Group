<?php
namespace Tests\Feature;
use App\Models\PageContent;
use App\Models\Settings;
use Database\Seeders\PageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CardsPageContentRenderTest extends TestCase
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

    public function test_cards_shows_seeded_content()
    {
        $this->get('/cards')->assertOk()
            ->assertSee('Cards Designed Around How You Spend')
            ->assertSee('Apply for a Credit Card')
            ->assertSee('Full Card Control at Your Fingertips')
            ->assertSee('Over 2 million credit card users');
    }
}
