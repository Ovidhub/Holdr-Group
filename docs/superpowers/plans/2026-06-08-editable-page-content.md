# Editable Page Content (Admin "Pages" CMS) Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Let the super admin edit every section's text on the Home, About, and Contact pages from the admin panel, seeded with original Mortil Holders copy.

**Architecture:** A `page_contents` table holds one row per editable field. A `PageContent` model exposes a cached lookup; a global `pc()` helper reads values in blades with a default fallback. An admin `PageContentController` lists pages and edits their sections grouped into labelled fields. A seeder installs all sections with the new copy. The three blades are wired to `pc()`.

**Tech Stack:** Laravel 8, PHP 8.1+, MySQL (prod) / SQLite in-memory (tests), Blade, PHPUnit.

**Spec:** `docs/superpowers/specs/2026-06-08-editable-page-content-design.md`

**Conventions:**
- Migrations are idempotent (`Schema::hasTable` guard) like the others in this repo.
- Run tests with: `php artisan test --filter <TestClass>`
- Local server (for manual checks) is on **port 8090**: `php -S 127.0.0.1:8090 serve-local.php`
- Commit messages end with the repo's `Co-Authored-By` trailer.

---

## Task 1: PageContent model + migration

**Files:**
- Create: `database/migrations/2023_01_02_000001_create_page_contents_table.php`
- Create: `app/Models/PageContent.php`
- Test: `tests/Feature/PageContentModelTest.php`

- [ ] **Step 1: Write the failing test**

```php
<?php
namespace Tests\Feature;
use App\Models\PageContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageContentModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_and_reads_a_section()
    {
        PageContent::create([
            'page' => 'home', 'section_key' => 'hero_heading',
            'label' => 'Hero heading', 'section_group' => 'Hero',
            'type' => 'text', 'value' => 'Hello', 'sort_order' => 1,
        ]);

        $this->assertDatabaseHas('page_contents', [
            'page' => 'home', 'section_key' => 'hero_heading', 'value' => 'Hello',
        ]);
    }

    public function test_value_returns_stored_value_and_default()
    {
        PageContent::create([
            'page' => 'home', 'section_key' => 'hero_heading',
            'label' => 'Hero heading', 'section_group' => 'Hero',
            'type' => 'text', 'value' => 'Stored', 'sort_order' => 1,
        ]);

        $this->assertSame('Stored', PageContent::value('home', 'hero_heading', 'def'));
        $this->assertSame('def', PageContent::value('home', 'missing', 'def'));
    }
}
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter PageContentModelTest`
Expected: FAIL — class `App\Models\PageContent` not found / table missing.

- [ ] **Step 3: Create the migration**

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageContentsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('page_contents')) {
            return;
        }

        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page', 50);
            $table->string('section_key', 100);
            $table->string('label');
            $table->string('section_group', 100)->default('General');
            $table->string('type', 20)->default('text');
            $table->text('value')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->unique(['page', 'section_key']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_contents');
    }
}
```

- [ ] **Step 4: Create the model**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class PageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page', 'section_key', 'label', 'section_group', 'type', 'value', 'sort_order',
    ];

    /** In-memory cache of all sections, keyed "page.section_key". */
    protected static $map = null;

    /**
     * Read a section's value (cached for the request). Never throws:
     * returns $default if the table/row is absent.
     */
    public static function value(string $page, string $key, string $default = ''): string
    {
        if (static::$map === null) {
            static::$map = [];
            try {
                if (Schema::hasTable('page_contents')) {
                    foreach (static::query()->get() as $row) {
                        static::$map[$row->page . '.' . $row->section_key] = (string) $row->value;
                    }
                }
            } catch (\Throwable $e) {
                static::$map = [];
            }
        }

        return static::$map[$page . '.' . $key] ?? $default;
    }

    public static function flushCache(): void
    {
        static::$map = null;
    }

    protected static function booted()
    {
        static::saved(fn () => static::flushCache());
        static::deleted(fn () => static::flushCache());
    }
}
```

- [ ] **Step 5: Run test to verify it passes**

Run: `php artisan test --filter PageContentModelTest`
Expected: PASS (2 tests).

- [ ] **Step 6: Commit**

```bash
git add database/migrations/2023_01_02_000001_create_page_contents_table.php app/Models/PageContent.php tests/Feature/PageContentModelTest.php
git commit -m "feat: add page_contents table and PageContent model

Co-Authored-By: Claude Opus 4.8 <noreply@anthropic.com>"
```

---

## Task 2: `pc()` global helper

**Files:**
- Create: `app/helpers.php`
- Modify: `composer.json` (autoload.files)
- Test: `tests/Feature/PcHelperTest.php`

- [ ] **Step 1: Write the failing test**

```php
<?php
namespace Tests\Feature;
use App\Models\PageContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PcHelperTest extends TestCase
{
    use RefreshDatabase;

    public function test_pc_returns_value_and_default()
    {
        PageContent::create([
            'page' => 'home', 'section_key' => 'hero_heading',
            'label' => 'Hero heading', 'section_group' => 'Hero',
            'type' => 'text', 'value' => 'Welcome', 'sort_order' => 1,
        ]);

        $this->assertSame('Welcome', pc('home', 'hero_heading'));
        $this->assertSame('fallback', pc('home', 'nope', 'fallback'));
    }
}
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter PcHelperTest`
Expected: FAIL — `Call to undefined function pc()`.

- [ ] **Step 3: Create the helper file**

```php
<?php

use App\Models\PageContent;

if (! function_exists('pc')) {
    /**
     * Fetch editable page content by page + section key, with a default fallback.
     */
    function pc(string $page, string $key, string $default = ''): string
    {
        return PageContent::value($page, $key, $default);
    }
}
```

- [ ] **Step 4: Register the helper in composer autoload**

In `composer.json`, change the `autoload` block to add a `files` array:

```json
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        },
        "files": [
            "app/helpers.php"
        ]
    },
```

- [ ] **Step 5: Regenerate the autoloader**

Run: `composer dump-autoload`
Expected: "Generated optimized autoload files".

- [ ] **Step 6: Run test to verify it passes**

Run: `php artisan test --filter PcHelperTest`
Expected: PASS.

- [ ] **Step 7: Commit**

```bash
git add app/helpers.php composer.json composer.lock tests/Feature/PcHelperTest.php
git commit -m "feat: add pc() page-content helper

Co-Authored-By: Claude Opus 4.8 <noreply@anthropic.com>"
```

---

## Task 3: PageContentSeeder with the new copy

**Files:**
- Create: `database/seeders/PageContentSeeder.php`
- Test: `tests/Feature/PageContentSeederTest.php`

- [ ] **Step 1: Write the failing test**

```php
<?php
namespace Tests\Feature;
use App\Models\PageContent;
use Database\Seeders\PageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageContentSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_inserts_sections_and_is_idempotent()
    {
        (new PageContentSeeder())->run();
        $countAfterFirst = PageContent::count();

        $this->assertGreaterThanOrEqual(40, $countAfterFirst);
        $this->assertSame('Move Money Across the World in Real Time',
            PageContent::value('home', 'hero_heading'));
        $this->assertSame('About Mortil Holders',
            PageContent::value('about', 'header_title'));
        $this->assertSame('Contact Us',
            PageContent::value('contact', 'header_title'));

        // Running again must not duplicate rows.
        (new PageContentSeeder())->run();
        $this->assertSame($countAfterFirst, PageContent::count());
    }
}
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter PageContentSeederTest`
Expected: FAIL — `Database\Seeders\PageContentSeeder` not found.

- [ ] **Step 3: Create the seeder**

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageContentSeeder extends Seeder
{
    public function run()
    {
        $now = now();
        $order = 0;

        foreach ($this->sections() as $row) {
            DB::table('page_contents')->updateOrInsert(
                ['page' => $row['page'], 'section_key' => $row['key']],
                [
                    'label' => $row['label'],
                    'section_group' => $row['group'],
                    'type' => $row['type'],
                    'value' => $row['value'],
                    'sort_order' => $order++,
                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }
    }

    private function sections(): array
    {
        return array_merge($this->home(), $this->about(), $this->contact());
    }

    private function home(): array
    {
        $p = 'home';
        return [
            ['page'=>$p,'key'=>'hero_eyebrow','label'=>'Hero eyebrow','group'=>'Hero','type'=>'text','value'=>'BANKING WITHOUT BORDERS'],
            ['page'=>$p,'key'=>'hero_heading','label'=>'Hero heading','group'=>'Hero','type'=>'text','value'=>'Move Money Across the World in Real Time'],
            ['page'=>$p,'key'=>'hero_subtext','label'=>'Hero subtext','group'=>'Hero','type'=>'textarea','value'=>'Mortil Holders brings modern, secure digital banking to everyone. Open an account in minutes, hold multiple currencies, and send money worldwide with transparent, low fees — all from one app.'],
            ['page'=>$p,'key'=>'hero_button','label'=>'Hero button label','group'=>'Hero','type'=>'text','value'=>'Open Online Banking'],
            ['page'=>$p,'key'=>'why_heading','label'=>'Why-us heading','group'=>'Why Us','type'=>'text','value'=>'We Reimagined Digital Banking'],
            ['page'=>$p,'key'=>'why_subtext','label'=>'Why-us text','group'=>'Why Us','type'=>'textarea','value'=>"For over a decade we've combined data, technology and thoughtful design to make banking simpler and more human. Today, millions trust Mortil Holders to manage, move and grow their money."],
            ['page'=>$p,'key'=>'feature_app_title','label'=>'Feature: app title','group'=>'Features','type'=>'text','value'=>'A Powerful Mobile & Online Experience'],
            ['page'=>$p,'key'=>'feature_app_body','label'=>'Feature: app body','group'=>'Features','type'=>'textarea','value'=>'Check balances, move funds, freeze cards and track every transaction in real time. Our mobile and web apps put complete control of your money in your hands, wherever you are.'],
            ['page'=>$p,'key'=>'feature_cards_title','label'=>'Feature: cards title','group'=>'Features','type'=>'text','value'=>'Set Up & Spend From Your Cards in a Minute'],
            ['page'=>$p,'key'=>'feature_cards_body','label'=>'Feature: cards body','group'=>'Features','type'=>'textarea','value'=>'Create virtual and physical cards instantly, set your own limits, and spend in the currency you choose — with total transparency and total speed.'],
            ['page'=>$p,'key'=>'feature_secure_title','label'=>'Feature: security title','group'=>'Features','type'=>'text','value'=>'Innovative, Secure and Truly Digital'],
            ['page'=>$p,'key'=>'feature_secure_body','label'=>'Feature: security body','group'=>'Features','type'=>'textarea','value'=>'Bank-grade encryption, two-factor authentication and round-the-clock monitoring keep your money and data safe, so you can focus on living rather than worrying.'],
            ['page'=>$p,'key'=>'tool_rates_title','label'=>'Tool: rates title','group'=>'Tools','type'=>'text','value'=>'Historical Currency Rates'],
            ['page'=>$p,'key'=>'tool_rates_body','label'=>'Tool: rates body','group'=>'Tools','type'=>'textarea','value'=>'Track how rates have moved over time and time your exchanges with confidence.'],
            ['page'=>$p,'key'=>'tool_travel_title','label'=>'Tool: travel title','group'=>'Tools','type'=>'text','value'=>'Travel Expense Calculator'],
            ['page'=>$p,'key'=>'tool_travel_body','label'=>'Tool: travel body','group'=>'Tools','type'=>'textarea','value'=>'Plan trips abroad with clear, upfront estimates of what your money is worth.'],
            ['page'=>$p,'key'=>'tool_alerts_title','label'=>'Tool: alerts title','group'=>'Tools','type'=>'text','value'=>'Currency Email Updates'],
            ['page'=>$p,'key'=>'tool_alerts_body','label'=>'Tool: alerts body','group'=>'Tools','type'=>'textarea','value'=>'Get the rates you care about delivered straight to your inbox.'],
            ['page'=>$p,'key'=>'platform_heading','label'=>'Platform heading','group'=>'Platform','type'=>'text','value'=>'Your One-Stop Digital Banking Platform'],
            ['page'=>$p,'key'=>'platform_body','label'=>'Platform body','group'=>'Platform','type'=>'textarea','value'=>'Exchange money across the world in real time with some of the lowest fees available, and hold and manage multiple currencies from a single, secure account.'],
            ['page'=>$p,'key'=>'stats_heading','label'=>'Stats heading','group'=>'Stats','type'=>'text','value'=>'Trusted by Millions Around the World'],
            ['page'=>$p,'key'=>'stats_value','label'=>'Stats figure','group'=>'Stats','type'=>'text','value'=>'18.5M+'],
            ['page'=>$p,'key'=>'stats_label','label'=>'Stats label','group'=>'Stats','type'=>'text','value'=>'Happy customers and growing'],
            ['page'=>$p,'key'=>'cta_heading','label'=>'CTA heading','group'=>'Call To Action','type'=>'text','value'=>'Ready to Bank Smarter?'],
            ['page'=>$p,'key'=>'cta_body','label'=>'CTA body','group'=>'Call To Action','type'=>'textarea','value'=>'Join Mortil Holders today and experience banking built for the way you live.'],
            ['page'=>$p,'key'=>'cta_button','label'=>'CTA button label','group'=>'Call To Action','type'=>'text','value'=>'Get Started'],
        ];
    }

    private function about(): array
    {
        $p = 'about';
        return [
            ['page'=>$p,'key'=>'header_title','label'=>'Header title','group'=>'Header','type'=>'text','value'=>'About Mortil Holders'],
            ['page'=>$p,'key'=>'header_subtext','label'=>'Header subtext','group'=>'Header','type'=>'textarea','value'=>"We're on a mission to make world-class banking simple, transparent and accessible to everyone."],
            ['page'=>$p,'key'=>'who_heading','label'=>'Who-we-are heading','group'=>'Who We Are','type'=>'text','value'=>'Used by 100K+ Businesses of Every Shape & Size'],
            ['page'=>$p,'key'=>'who_body','label'=>'Who-we-are body','group'=>'Who We Are','type'=>'textarea','value'=>'From freelancers to fast-growing companies, organisations rely on Mortil Holders to hold multiple currencies, pay teams and suppliers worldwide, and move money in real time.'],
            ['page'=>$p,'key'=>'story_heading','label'=>'Story heading','group'=>'Our Story','type'=>'text','value'=>'Digital Banking, Reinvented'],
            ['page'=>$p,'key'=>'story_body','label'=>'Story body','group'=>'Our Story','type'=>'textarea','value'=>'Mortil Holders was founded on a simple idea: banking should work for people, not the other way around. We replaced paperwork and hidden fees with a fast, secure, mobile-first platform you can trust.'],
            ['page'=>$p,'key'=>'feature_app_title','label'=>'Feature: app title','group'=>'Features','type'=>'text','value'=>'Powerful Mobile & Online App'],
            ['page'=>$p,'key'=>'feature_app_body','label'=>'Feature: app body','group'=>'Features','type'=>'textarea','value'=>'Everything you need to manage your money, on any device, around the clock.'],
            ['page'=>$p,'key'=>'feature_team_title','label'=>'Feature: teams title','group'=>'Features','type'=>'text','value'=>'Built for Multiple Users & Teams'],
            ['page'=>$p,'key'=>'feature_team_body','label'=>'Feature: teams body','group'=>'Features','type'=>'textarea','value'=>'Give your business controlled, role-based access so the right people manage the right money.'],
            ['page'=>$p,'key'=>'customers_heading','label'=>'Customers heading','group'=>'Customers','type'=>'text','value'=>'We Always Aim to Exceed Your Expectations'],
            ['page'=>$p,'key'=>'customers_body','label'=>'Customers body','group'=>'Customers','type'=>'textarea','value'=>'Our product and our people are built around your needs, with responsive support whenever you need it.'],
            ['page'=>$p,'key'=>'cta_heading','label'=>'CTA heading','group'=>'Call To Action','type'=>'text','value'=>'Have Questions? Download Our App'],
            ['page'=>$p,'key'=>'cta_body','label'=>'CTA body','group'=>'Call To Action','type'=>'textarea','value'=>'Get started with Mortil Holders in minutes and take your banking with you everywhere.'],
        ];
    }

    private function contact(): array
    {
        $p = 'contact';
        return [
            ['page'=>$p,'key'=>'header_title','label'=>'Header title','group'=>'Header','type'=>'text','value'=>'Contact Us'],
            ['page'=>$p,'key'=>'header_subtext','label'=>'Header subtext','group'=>'Header','type'=>'textarea','value'=>"We'd love to hear from you. Reach out and our team will get back to you as soon as possible."],
            ['page'=>$p,'key'=>'location_label','label'=>'Location label','group'=>'Details','type'=>'text','value'=>'Our Location'],
            ['page'=>$p,'key'=>'location_value','label'=>'Location value','group'=>'Details','type'=>'text','value'=>'London, United Kingdom'],
            ['page'=>$p,'key'=>'email_label','label'=>'Email label','group'=>'Details','type'=>'text','value'=>'Email Us'],
            ['page'=>$p,'key'=>'email_value','label'=>'Email value','group'=>'Details','type'=>'text','value'=>'info@mortilholders.online'],
            ['page'=>$p,'key'=>'phone_label','label'=>'Phone label','group'=>'Details','type'=>'text','value'=>'Call Us'],
            ['page'=>$p,'key'=>'phone_value','label'=>'Phone value','group'=>'Details','type'=>'text','value'=>'+44 20 0000 0000'],
        ];
    }
}
```

- [ ] **Step 4: Run test to verify it passes**

Run: `php artisan test --filter PageContentSeederTest`
Expected: PASS.

- [ ] **Step 5: Register seeder in DatabaseSeeder (optional call) and run locally**

Add this line inside `database/seeders/DatabaseSeeder.php`'s `run()` method:

```php
$this->call(PageContentSeeder::class);
```

Then load it into the local MySQL DB:
Run: `php artisan db:seed --class=PageContentSeeder`
Expected: "Database seeding completed successfully."

- [ ] **Step 6: Commit**

```bash
git add database/seeders/PageContentSeeder.php database/seeders/DatabaseSeeder.php tests/Feature/PageContentSeederTest.php
git commit -m "feat: seed page_contents with Mortil Holders copy

Co-Authored-By: Claude Opus 4.8 <noreply@anthropic.com>"
```

---

## Task 4: Admin Pages editor (controller, routes, views, sidebar)

**Files:**
- Create: `app/Http/Controllers/Admin/PageContentController.php`
- Create: `resources/views/admin/pages/index.blade.php`
- Create: `resources/views/admin/pages/edit.blade.php`
- Modify: `routes/admin.php` (add `use` import + 3 routes in the `['isadmin','2fa']` group)
- Modify: `resources/views/admin/sidebar.blade.php` (add nav link)
- Test: `tests/Feature/PageContentAdminTest.php`

- [ ] **Step 1: Write the failing test**

```php
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
            'enable_2fa' => 'disabled', 'status' => 'active', 'type' => 'Super Admin',
            'dashboard_style' => 'light',
        ])->save();
        return $a;
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(TwoFactorVerify::class);
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
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter PageContentAdminTest`
Expected: FAIL — route `/admin/dashboard/pages` not defined (404) / controller missing.

- [ ] **Step 3: Create the controller**

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    /** Editable pages: slug => display name. */
    protected $pages = [
        'home'    => 'Home',
        'about'   => 'About Us',
        'contact' => 'Contact',
    ];

    public function index()
    {
        return view('admin.pages.index', [
            'title' => 'Pages',
            'pages' => $this->pages,
        ]);
    }

    public function edit($page)
    {
        abort_unless(isset($this->pages[$page]), 404);

        $sections = PageContent::where('page', $page)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('section_group');

        return view('admin.pages.edit', [
            'title'    => $this->pages[$page] . ' page content',
            'page'     => $page,
            'pageName' => $this->pages[$page],
            'sections' => $sections,
        ]);
    }

    public function update($page, Request $request)
    {
        abort_unless(isset($this->pages[$page]), 404);

        foreach ((array) $request->input('sections', []) as $key => $value) {
            $row = PageContent::where('page', $page)->where('section_key', $key)->first();
            if ($row) {
                $row->value = $value;
                $row->save(); // fires saved() -> flushes the pc() cache
            }
        }

        return redirect()->route('pages.edit', $page)
            ->with('success', 'Page content updated successfully');
    }
}
```

- [ ] **Step 4: Add routes**

In `routes/admin.php`, add this import near the other `use App\Http\Controllers\Admin\...` lines (top of file):

```php
use App\Http\Controllers\Admin\PageContentController;
```

Then add these three routes **inside** the existing `Route::middleware(['isadmin', '2fa'])->prefix('admin')->group(function () { ... });` block (e.g. right after the `dashboard/frontpage` route):

```php
	// Editable page content (CMS)
	Route::get('dashboard/pages', [PageContentController::class, 'index'])->name('pages.index');
	Route::get('dashboard/pages/{page}', [PageContentController::class, 'edit'])->name('pages.edit');
	Route::put('dashboard/pages/{page}', [PageContentController::class, 'update'])->name('pages.update');
```

- [ ] **Step 5: Create the index view**

`resources/views/admin/pages/index.blade.php`:

```blade
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1">Pages</h1>
                    <p>Edit the content shown on each public page.</p>
                </div>
                <x-success-alert />
                <div class="row">
                    @foreach ($pages as $slug => $name)
                        <div class="col-md-4 mb-3">
                            <div class="card p-3 shadow">
                                <h4>{{ $name }}</h4>
                                <a href="{{ route('pages.edit', $slug) }}" class="btn btn-primary mt-2">
                                    <i class="fa fa-edit"></i> Edit content
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
```

- [ ] **Step 6: Create the edit view**

`resources/views/admin/pages/edit.blade.php`:

```blade
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4 d-flex justify-content-between align-items-center">
                    <h1 class="title1">Edit: {{ $pageName }}</h1>
                    <a href="{{ route('pages.index') }}" class="btn btn-secondary">Back to pages</a>
                </div>
                <x-success-alert />
                <x-danger-alert />
                <form method="post" action="{{ route('pages.update', $page) }}">
                    @csrf
                    @method('PUT')
                    @foreach ($sections as $group => $rows)
                        <div class="card p-3 shadow mb-4">
                            <h4 class="mb-3"><strong>{{ $group }}</strong></h4>
                            @foreach ($rows as $row)
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ $row->label }}</label>
                                    @if ($row->type === 'textarea')
                                        <textarea name="sections[{{ $row->section_key }}]" rows="3"
                                            class="form-control">{{ $row->value }}</textarea>
                                    @else
                                        <input type="text" name="sections[{{ $row->section_key }}]"
                                            value="{{ $row->value }}" class="form-control">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary mb-5">Save changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
```

- [ ] **Step 7: Add the sidebar link**

In `resources/views/admin/sidebar.blade.php`, add this `<li>` immediately after the existing `frontpage` / front-page-management link (search for `frontpage` in the file; if absent, place it near the other settings links):

```blade
                <li class="nav-item {{ request()->routeIs('pages.index') ? 'active' : '' }}">
                    <a href="{{ route('pages.index') }}">
                        <i class="fas fa-file-alt"></i>
                        <p>Pages</p>
                    </a>
                </li>
```

- [ ] **Step 8: Run test to verify it passes**

Run: `php artisan test --filter PageContentAdminTest`
Expected: PASS (4 tests).

- [ ] **Step 9: Commit**

```bash
git add app/Http/Controllers/Admin/PageContentController.php resources/views/admin/pages routes/admin.php resources/views/admin/sidebar.blade.php tests/Feature/PageContentAdminTest.php
git commit -m "feat: admin Pages editor for page content

Co-Authored-By: Claude Opus 4.8 <noreply@anthropic.com>"
```

---

## Task 5: Wire the Home template to `pc()`

**Files:**
- Modify: `resources/views/home/index.blade.php`
- Test: `tests/Feature/HomePageContentRenderTest.php`

The render test needs a minimal `settings` row (the public layout reads `$settings`).
All `settings` columns are nullable, so a tiny row renders fine; `modules` is cast to
array, so seed it as `[]`.

- [ ] **Step 1: Write the failing test**

```php
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
        Settings::forceCreate([
            'id' => 1, 'site_name' => 'Mortil Holders',
            'site_address' => 'https://mortilholders.online', 'modules' => [],
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
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter HomePageContentRenderTest`
Expected: FAIL — page still shows the old hardcoded "Transfer Money Across The World In Real time".

- [ ] **Step 3: Wire the hero (worked example)**

In `resources/views/home/index.blade.php`, replace the hero block (around lines 14-18):

Find:
```blade
    <span data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">SIMPLE, QUICK, SECURED</span>
    <h1 data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">Transfer Money Across The World In Real time</h1>
    <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">{{$settings->site_name}} transformed the digital banking industry using data and technology more than ten years ago. We are now one of the largest digital banking providers, dedicated to innovating, simplifying, and humanizing banking.</p>
```
Replace with:
```blade
    <span data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">{{ pc('home','hero_eyebrow') }}</span>
    <h1 data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">{{ pc('home','hero_heading') }}</h1>
    <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">{{ pc('home','hero_subtext') }}</p>
```

And the hero button — find `>ONLINE BANKING<` and replace the link text:
```blade
    <a href="login" class="btn style1">{{ pc('home','hero_button') }}<i class="ri-arrow-right-s-line"></i></a>
```

- [ ] **Step 4: Wire the remaining Home sections**

Apply the same pattern (replace the hardcoded text node, keep all surrounding markup/attributes) for each key below. Open the file, locate each section by its **current heading text** (left column), and swap the heading and its adjacent paragraph for the `pc()` calls. Leave the currency-code list, testimonials loop, and FAQ loop untouched.

| current heading text (anchor) | heading → | adjacent paragraph → |
|---|---|---|
| We revolutionized Digital Banking | `{{ pc('home','why_heading') }}` | `{{ pc('home','why_subtext') }}` |
| Powerful Mobile & Online App / Brings More Transperency & Speed | `{{ pc('home','feature_app_title') }}` | `{{ pc('home','feature_app_body') }}` |
| Set Up & Exchange Money From Your Cards In A Minute | `{{ pc('home','feature_cards_title') }}` | `{{ pc('home','feature_cards_body') }}` |
| We are innovative and digital | `{{ pc('home','feature_secure_title') }}` | `{{ pc('home','feature_secure_body') }}` |
| Historical Currency Rates | `{{ pc('home','tool_rates_title') }}` | `{{ pc('home','tool_rates_body') }}` |
| Travel Expense Calculator | `{{ pc('home','tool_travel_title') }}` | `{{ pc('home','tool_travel_body') }}` |
| Currency Email Updates | `{{ pc('home','tool_alerts_title') }}` | `{{ pc('home','tool_alerts_body') }}` |
| Exchange Money Across The World... / Your one-stop digital banking platform | `{{ pc('home','platform_heading') }}` | `{{ pc('home','platform_body') }}` |
| More Than 18M+ Happy Customers Trust Our Services | `{{ pc('home','stats_heading') }}` | stats figure `18M+`/`18.5M+` → `{{ pc('home','stats_value') }}`, label → `{{ pc('home','stats_label') }}` |

For the closing call-to-action band near the bottom of the page (heading + button + supporting line), wire heading → `{{ pc('home','cta_heading') }}`, body → `{{ pc('home','cta_body') }}`, button label → `{{ pc('home','cta_button') }}`.

- [ ] **Step 5: Run test to verify it passes**

Run: `php artisan test --filter HomePageContentRenderTest`
Expected: PASS.

- [ ] **Step 6: Commit**

```bash
git add resources/views/home/index.blade.php tests/Feature/HomePageContentRenderTest.php
git commit -m "feat: wire Home page sections to editable content

Co-Authored-By: Claude Opus 4.8 <noreply@anthropic.com>"
```

---

## Task 6: Wire the About template to `pc()`

**Files:**
- Modify: `resources/views/home/about.blade.php`
- Test: `tests/Feature/AboutPageContentRenderTest.php`

- [ ] **Step 1: Write the failing test**

```php
<?php
namespace Tests\Feature;
use App\Models\Settings;
use Database\Seeders\PageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutPageContentRenderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Settings::forceCreate([
            'id' => 1, 'site_name' => 'Mortil Holders',
            'site_address' => 'https://mortilholders.online', 'modules' => [],
            'trade_mode' => 'on', 'weekend_trade' => 'on',
        ]);
        (new PageContentSeeder())->run();
    }

    public function test_about_shows_seeded_header()
    {
        $this->get('/about')->assertOk()
            ->assertSee('About Mortil Holders')
            ->assertSee('Digital Banking, Reinvented');
    }
}
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter AboutPageContentRenderTest`
Expected: FAIL — old "About Us" template text, seeded strings absent.

- [ ] **Step 3: Wire the About sections**

In `resources/views/home/about.blade.php`, replace each hardcoded heading/paragraph using the mapping (locate by current heading text, keep surrounding markup):

| current heading text (anchor) | heading → | adjacent paragraph → |
|---|---|---|
| About Us (page header) | `{{ pc('about','header_title') }}` | header sub-line → `{{ pc('about','header_subtext') }}` |
| Used By 100K+ Businesses Of All Shapes & Sizes | `{{ pc('about','who_heading') }}` | `{{ pc('about','who_body') }}` |
| Digital Banking was revolutionized by us. | `{{ pc('about','story_heading') }}` | `{{ pc('about','story_body') }}` |
| Powerful Mobile & Online App | `{{ pc('about','feature_app_title') }}` | `{{ pc('about','feature_app_body') }}` |
| Special For Multiple User Capabilities | `{{ pc('about','feature_team_title') }}` | `{{ pc('about','feature_team_body') }}` |
| We Always Try To Understand Customer's Expectation | `{{ pc('about','customers_heading') }}` | `{{ pc('about','customers_body') }}` |
| Let's Answer Some Of Your Questions Or Download Our App | `{{ pc('about','cta_heading') }}` | `{{ pc('about','cta_body') }}` |

- [ ] **Step 4: Run test to verify it passes**

Run: `php artisan test --filter AboutPageContentRenderTest`
Expected: PASS.

- [ ] **Step 5: Commit**

```bash
git add resources/views/home/about.blade.php tests/Feature/AboutPageContentRenderTest.php
git commit -m "feat: wire About page sections to editable content

Co-Authored-By: Claude Opus 4.8 <noreply@anthropic.com>"
```

---

## Task 7: Wire the Contact template to `pc()`

**Files:**
- Modify: `resources/views/home/contact.blade.php`
- Test: `tests/Feature/ContactPageContentRenderTest.php`

- [ ] **Step 1: Write the failing test**

```php
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
        Settings::forceCreate([
            'id' => 1, 'site_name' => 'Mortil Holders',
            'site_address' => 'https://mortilholders.online', 'modules' => [],
            'trade_mode' => 'on', 'weekend_trade' => 'on',
        ]);
        (new PageContentSeeder())->run();
    }

    public function test_contact_shows_seeded_content()
    {
        $this->get('/contact')->assertOk()
            ->assertSee('Contact Us')
            ->assertSee('info@mortilholders.online');
    }
}
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter ContactPageContentRenderTest`
Expected: FAIL — seeded email/intro absent.

- [ ] **Step 3: Wire the Contact sections**

In `resources/views/home/contact.blade.php`, replace using the mapping:

| current text (anchor) | replace with |
|---|---|
| Contact Us (header) | `{{ pc('contact','header_title') }}` |
| header intro paragraph (under the title) | `{{ pc('contact','header_subtext') }}` |
| Our Location (label) | `{{ pc('contact','location_label') }}` |
| location value (address text under it) | `{{ pc('contact','location_value') }}` |
| Email Us (label) | `{{ pc('contact','email_label') }}` |
| email value (the displayed email/`$settings->contact_email`) | `{{ pc('contact','email_value') }}` |
| Phone (label) | `{{ pc('contact','phone_label') }}` |
| phone value (number under it) | `{{ pc('contact','phone_value') }}` |

- [ ] **Step 4: Run test to verify it passes**

Run: `php artisan test --filter ContactPageContentRenderTest`
Expected: PASS.

- [ ] **Step 5: Commit**

```bash
git add resources/views/home/contact.blade.php tests/Feature/ContactPageContentRenderTest.php
git commit -m "feat: wire Contact page sections to editable content

Co-Authored-By: Claude Opus 4.8 <noreply@anthropic.com>"
```

---

## Task 8: Full-suite check and manual verification

- [ ] **Step 1: Run the whole new suite**

Run: `php artisan test --filter "PageContent|PcHelper|HomePageContentRender|AboutPageContentRender|ContactPageContentRender"`
Expected: all PASS.

- [ ] **Step 2: Run the complete test suite (no regressions in our area)**

Run: `php artisan test`
Expected: the new tests PASS; pre-existing stock-Jetstream failures are unchanged from before this work.

- [ ] **Step 3: Manual check in the browser**

Ensure local DB is seeded: `php artisan db:seed --class=PageContentSeeder`
Start server (if not running): `php -S 127.0.0.1:8090 serve-local.php`
Visit: `http://127.0.0.1:8090/` , `/about`, `/contact` — confirm new copy shows.
Log in at `/admin/login` → sidebar **Pages** → edit **Home** → change the hero heading → Save → reload `/` and confirm the change.

- [ ] **Step 4: Final commit (if any cleanup)**

```bash
git add -A
git commit -m "chore: finalize editable page content feature

Co-Authored-By: Claude Opus 4.8 <noreply@anthropic.com>"
```

---

## Notes / risks

- **`pc()` cache:** flushed automatically on any `PageContent` save/delete via the model's `booted()` hooks, so admin edits show immediately (and tests that edit-then-render work in one process).
- **Render tests need a `settings` row:** seeded minimally in each render test's `setUp`. If a wired page errors in tests on some other `$settings` field, add that field to the `forceCreate` array (all settings columns are nullable).
- **Admin tests bypass 2FA** via `withoutMiddleware(TwoFactorVerify::class)` and authenticate on the `admin` guard.
- **Production rollout:** `php artisan migrate` then `php artisan db:seed --class=PageContentSeeder`; thereafter editable in admin → Pages.
- **Extensibility:** to make another page editable later, add its rows to the seeder, add the slug to `PageContentController::$pages`, and wire that blade — no schema/UI changes.
```
