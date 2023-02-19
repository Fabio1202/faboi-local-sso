<?php

namespace App\Http\Controllers;

class ApplicationController extends Controller
{
    public function index()
    {
        // Show paginated list of applications
        return view('applications.index', [
            'applications' => \App\Models\Application::paginate(10),
        ]);
    }
}
