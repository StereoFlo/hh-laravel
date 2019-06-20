<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AbstractController;
use Illuminate\Http\RedirectResponse;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends AbstractController
{
    /**
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('admin_user_list');
    }
}
