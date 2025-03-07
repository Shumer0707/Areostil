<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index(){
        $project = Project::with(['translation', 'images'])->findOrFail(10);
        dd($project);
        // dd(App::getLocale());
        return view('dev');
    }
}
