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
            ->assertSee('Banking That Puts You First')
            ->assertSee('Everything You Need for Day-to-Day Banking')
            ->assertSee('Your Finances, Wherever You Are')
            ->assertSee('Over 9.2 million downloads worldwide');
    }
}
