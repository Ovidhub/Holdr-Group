<?php
namespace Tests\Feature;
use App\Models\PageContent;
use App\Models\Settings;
use Database\Seeders\PageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoansPageContentRenderTest extends TestCase
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

    public function test_loans_shows_seeded_content()
    {
        $this->get('/loans')->assertOk()
            ->assertSee('Bespoke Credit Facilities & Flexible Lending Solutions')
            ->assertSee('Structured Financing With Rapid Decisions')
            ->assertSee('Fast, Transparent Capital for Your Next Milestone')
            ->assertSee('Over 750K+ personal and commercial credit facilities funded');
    }
}
