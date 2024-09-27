<?php

namespace App\Http\Controllers;

use App\Models\UrlShortener;
use Illuminate\Http\Request;

class OriginalUrlRedirectController extends Controller
{
    public function redirectedToOrinalUrl(UrlShortener $url)
    {
        return redirect()->to($url->original_url);
    }
}
