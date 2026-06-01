<?php

namespace App\Http\Controllers;

use App\Support\WebsiteSeo;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FaviconController extends Controller
{
    public function png(): BinaryFileResponse|Response
    {
        $path = WebsiteSeo::faviconDiskPath(globalData());

        if ($path === null) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => WebsiteSeo::faviconMime($path),
            'Cache-Control' => 'public, max-age=604800',
        ]);
    }

    public function ico(): Response
    {
        return redirect()->route('favicon.png', [], 301);
    }
}
