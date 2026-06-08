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
            ->assertSee('Flexible Loans for Every Stage of Life')
            ->assertSee('Apply for a Loan Today')
            ->assertSee('Fast Financing for Your Next Chapter')
            ->assertSee('Over 700K+ loans approved');
    }
}
