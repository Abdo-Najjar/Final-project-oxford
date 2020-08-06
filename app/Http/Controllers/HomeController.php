<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralResource;
use App\Section;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function home()
    {
        
        $studentsCount =  User::where('usertype_id' , User::STUDENT_TYPE)->count();

        $teachersCount = User::where('usertype_id' , User::TEACHER_TYPE)->count();

        $sectionsCount = Section::count();

        return new GeneralResource([
            'students'=>$studentsCount,
            'teachers'=>$teachersCount,
            'sections'=>$sectionsCount
        ]);
    }

}
