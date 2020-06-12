<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UseCases\Handlers\PostHandler;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @var PostHandler
     */
    private $postHandler;

    public function __construct(PostHandler $postHandler)
    {
        $this->postHandler = $postHandler;
    }

    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $posts = $this->postHandler->getPosts($page);
        return view('posts', ['posts' => $posts]);
    }
}
