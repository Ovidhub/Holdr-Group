<?php
namespace Tests\Feature;
use App\Http\Middleware\TwoFactorVerify;
use App\Models\Admin;
use App\Models\PageContent;
use Database\Seeders\PageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PageContentAdminTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): Admin
    {
        $a = new Admin();
        $a->forceFill([
            'firstName' => 'Test', 'lastName' => 'Admin',
            'email' => 'pctest@admin.com', 'password' => Hash::make('secret123'),
            'status' => 'active', 'type' => 'Super Admin',
            'dashboard_style' => 'light',
        ])->save();
        return $a;
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(TwoFactorVerify::class);
        PageContent::flushCache();
        (new PageContentSeeder())->run();
    }

    public function test_admin_can_view_pages_index()
    {
        $this->actingAs($this->admin(), 'admin')
            ->get('/admin/dashboard/pages')
            ->assertOk()->assertSee('About Us');
    }

    public function test_admin_can_view_page_editor()
    {
        $this->actingAs($this->admin(), 'admin')
            ->get('/admin/dashboard/pages/home')
            ->assertOk()->assertSee('Hero heading');
    }

    public function test_unknown_page_returns_404()
    {
        $this->actingAs($this->admin(), 'admin')
            ->get('/admin/dashboard/pages/nope')
            ->assertNotFound();
    }

    public function test_admin_can_update_sections()
    {
        $this->actingAs($this->admin(), 'admin')
            ->put('/admin/dashboard/pages/home', [
                'sections' => ['hero_heading' => 'Brand New Heading'],
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('page_contents', [
            'page' => 'home', 'section_key' => 'hero_heading', 'value' => 'Brand New Heading',
        ]);
        $this->assertSame('Brand New Heading', PageContent::value('home', 'hero_heading'));
    }
}
