<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\Plataformas;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(){
        $cursos = Cursos::all();
        $plataformas = Plataformas::all();
        return view('welcome',compact('cursos','plataformas'));
    }
}
