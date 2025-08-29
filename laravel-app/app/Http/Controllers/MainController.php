<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Menu;
use App\Models\MenuItem;

class MainController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        $menu = MenuItem::where('menu_id', 1)->get();
        return view('index', compact('pages', 'menu'));
    }
}
