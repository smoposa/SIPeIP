<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private readonly DashboardService $service) {}

    public function index(): View
    {
        $this->autorizar('dashboard');
        $usuario = Auth::user();
        abort_unless($usuario instanceof User, 401);

        return view('dashboard', $this->service->datos($usuario));
    }
}
