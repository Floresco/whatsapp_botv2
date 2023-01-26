<?php

namespace App\Http\Controllers\dashboard;

use App\Helpers\Utils;
use App\Http\Controllers\BaseController;
use App\Traits\SelectMenu;
use Illuminate\Auth\Access\AuthorizationException;

class DashboardController extends BaseController
{
    use SelectMenu;
    public function __construct()
    {
        $this->setSelectMenu('BOARD');
    }

    /**
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('manage_dashboard', 'READ');
        $this->setSelectSmenu("READ_DASHBOARD");
        $this->select_menu();

        return view('dashboard.dashboard');
    }
}
