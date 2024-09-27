<?php

namespace App\Http\Controllers;

use App\Models\UrlShortener;
use Illuminate\Http\Request;

class ShortUrlRedirectController extends Controller
{
    public function redirectedToOriginalUrl($shortUrl)
    {
        $url = UrlShortener::where('shorten_url', $shortUrl)->first();

        if (!$url) {
            abort(404, 'Short url not found');
        }

        $url->update(['click_count' => $url->click_count + 1]);
        app((OriginalUrlRedirectController::class)->redirectedToOrinalUrl($url));

    }
}
