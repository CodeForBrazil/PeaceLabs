<?php

namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Project;

/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        javascript()->put([
            'test' => 'it works!',
        ]);

        return view('frontend.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function home()
    {
    	$projects = Project::limit(9)->orderBy('created_at', 'desc')->get();
        return view('frontend.home', compact('projects'));
    }
    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }
}
