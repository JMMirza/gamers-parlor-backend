<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserGamerTag;
use Illuminate\Http\Request;

class UserGamerTagController extends Controller
{
    public function storeTag(Request $request)
    {
        $user_id =  $request->user()->id;
        $platform_id = $request->platform_id;
        $gamer_tag = $request->gamer_tag;

        UserGamerTag::create([
            'user_id' => $user_id,
            'platform_id' => $platform_id,
            'gamer_tag' => $gamer_tag
        ]);
        return response('Gamer Tag created', 200);
    }
}
