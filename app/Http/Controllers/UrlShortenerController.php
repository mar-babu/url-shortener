<?php

namespace App\Http\Controllers;

use App\Actions\ShortUrl;
use App\Http\Requests\UrlShortenerRequest;
use App\Models\UrlShortener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlShortenerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shortenedUrls = UrlShortener::get();

        return view('dashboard', compact('shortenedUrls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function urlShortener(UrlShortenerRequest $request, ShortUrl $shortUrl)
    {
        $authId = Auth::guard('web')->id();
        $shorten = $shortUrl->create($request->all(), $authId);

        toastr()->success('Url Shortened Successfully.');
        return redirect()->back();

    }
    
}
