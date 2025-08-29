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

        public function contact()
        {
            $pages = Page::all();
            $menu = MenuItem::where('menu_id', 1)->get();
            return view('contact', compact('pages', 'menu'));
        }

        public function page($key)
        {
            $pages = Page::where('slug', $key)->first();
            $menu = MenuItem::where('menu_id', 1)->get();
            return view('pages.page', compact('pages', 'menu'));
        }

}
