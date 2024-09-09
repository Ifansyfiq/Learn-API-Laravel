<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function index()
    {
        $posts = Post::all();

        // return response()
        //     ->json(['data2' => $posts]);

        return PostResource::collection($posts);
    }
}
