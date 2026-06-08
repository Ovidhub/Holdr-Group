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
