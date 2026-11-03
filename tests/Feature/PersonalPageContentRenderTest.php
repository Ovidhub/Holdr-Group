<?php
namespace Tests\Feature;
use App\Models\PageContent;
use App\Models\Settings;
use Database\Seeders\PageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonalPageContentRenderTest extends TestCase
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

    public function test_personal_shows_seeded_content()
    {
        $this->get('/personal')->assertOk()
            ->assertSee('Private & Personal Banking Tailored Around Your Life')
            ->assertSee('Effortless Everyday Banking Meets Private Wealth Stewardship')
            ->assertSee('Total Clarity Over Your Personal Wealth, 24/7')
            ->assertSee('Over 9.2 million personal banking clients worldwide');
    }
}
