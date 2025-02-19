<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function images($filename)
    {
        $path = Storage::path('images/' . $filename);

        if (!Auth::check()) {
            abort(403);
        }

        return response()->file($path);
    }

}
