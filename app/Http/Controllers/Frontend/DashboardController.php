<?php

namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return view('frontend.user.dashboard')
            ->withUser(auth()->user());
    }
}
