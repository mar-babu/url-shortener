<?php

namespace App\Http\Controllers\Api;

use App\Actions\ShortUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\UrlShortenerRequest;
use App\Http\Resources\UrlShortendResource;
use App\Models\UrlShortener;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlShortenerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $authId = Auth::guard('api')->id();
        $shortenedUrls = UrlShortener::where('user_id', $authId)->get();

        return response()->json([
            'status' => 200,
            'data' => UrlShortendResource::collection($shortenedUrls)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function urlShortener(UrlShortenerRequest $request, ShortUrl $shortUrl)
    {
        $authId = Auth::guard('api')->id();
        $shortened = $shortUrl->create($request->all(), $authId);

        return response()->json([
            'status' => 201,
            'shortened_url' => base_path('/').$shortened,
            'msg' => 'Url Shortened Successfully.'
        ]);

    }
}
