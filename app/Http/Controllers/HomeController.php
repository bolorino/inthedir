<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): View
    {
        seo()->title('Inthedir: Directorio teatral');
        seo()->description('Directorio de teatros y salas alternativas en España');
        seo()->image('/images/inthedir.png');

        $totalRegisters = Organization::count();

        return view('home', compact('totalRegisters'));
    }

    public function approve(): View
    {
        return view('approval');
    }
}
