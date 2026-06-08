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
