<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function client()
    {
        $token = config('services.tmdb.token');

        return Http::withOptions([
            'base_uri' => 'https://api.themoviedb.org/3/',
            'headers'  => [
                'Authorization' => "Bearer {$token}"
            ],
//            'proxy'    => 'http://192.168.49.1:8282'
        ]);
    }
}
