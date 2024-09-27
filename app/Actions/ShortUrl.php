<?php

namespace App\Actions;

use App\Models\UrlShortener;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ShortUrl
{
    public function create($data, $authId)
    {
        try {
            $rendomStr = Str::random(8);

            $url = UrlShortener::create([
                'user_id' => $authId,
                'name' => $data['name'],
                'shorten_url' => $rendomStr,
                'original_url' => $data['url'],
            ]);

            return $url->shorten_url;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

    }
}
