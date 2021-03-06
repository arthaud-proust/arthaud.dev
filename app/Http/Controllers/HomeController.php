<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use Validator;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function index()
    {
        $sections = Section::where('pages', 'LIKE', '%/,%')->orderBy('order')->get();
        return view('home', compact('sections'));
    }

    public function showPage($pageName)
    {
        $sections = Section::where('pages', 'LIKE', '%/'.$pageName.',%')->orderBy('order')->get();
        if($sections->count()==0) {
            $sections = Section::where('title', ucfirst(preg_replace('/-/',' ', $pageName)))->orderBy('order')->get();
            if($sections->count()==0) {
                abort(404);
            }
        }
        return view('page', compact('sections'));
    }

    public function showCategoryPage($category, $pageName)
    {
        $sections = Section::where('pages', 'LIKE', '%/'.$category.'/'.$pageName.',%')->orderBy('order')->get();
        if($sections->count()==0) {
            $sections = Section::where('title', ucfirst(preg_replace('/-/',' ', $pageName)))->orderBy('order')->get();
            if($sections->count()==0) {
                abort(404);
            }
        }
        return view('page', compact('sections'));
    }

    public function showSubCategoryPage($category, $subcategory, $pageName)
    {
        $sections = Section::where('pages', 'LIKE', '%/'.$category.'/'.$subcategory.'/'.$pageName.',%')->orderBy('order')->get();
        if($sections->count()==0) {
            $sections = Section::where('title', ucfirst(preg_replace('/-/',' ', $pageName)))->orderBy('order')->get();
            if($sections->count()==0) {
                abort(404);
            }
        }
        return view('page', compact('sections'));
    }

}
