<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\CityRepositoryInterface;

class AdminHomeController extends Controller
{
    public function index(UserRepositoryInterface $userRepo, 
        CategoryRepositoryInterface $categoryRepo, CourseRepositoryInterface $courseRepo,
         CountryRepositoryInterface $countryRepo, CityRepositoryInterface $cityRepo)
    {
        //users
        $users = $userRepo->getAll();
        $instructors = $users->where('type', 'Instructor');
        $students = $users->where('type', 'Student');
        //categories
        $categories = $categoryRepo->getAll();
        //courses
        $courses = $courseRepo->getAll();
        //countries
        $countries = $countryRepo->getAll();
         //cities
         $cities = $cityRepo->getAll();

         //bar char instructors count per category
         $chartjs = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 350, 'height' => 150])
         ->datasets(
            $categories->map(function($category) use ($instructors){
                return [
                    'label' => $category->name,
                    'backgroundColor' => [$this->random_color()],
                    'data' => [round(($category->instructors->count() / $instructors->count() * 100))]
                ];
            })->toArray())->options([]);

        // pie chart students per country
        $chartjs2 = app()->chartjs
        ->name('barChartTest2')
        ->type('doughnut')
        ->size(['width' => 350, 'height' => 230])
        ->labels($countries->pluck('name')->toArray())
        ->datasets([
            [
                "label" => "My First Dataset",
                'backgroundColor' => $countries->map(function ($country){
                    return $this->random_color();
                }),
                'data' => $countries->map(function($country) use ($students){
                    return (round($country->students->count() / $students->count() * 100));
                })->toArray()
            ],
        ])
        ->options([
            'hoverOffset' => 4,
        ]);
        //return home view with required data 
        return view('admin.home', [
        'users' => $users->count(), 
        'instructors' => $instructors->count(),
        'students' => $students->count(),
        'categories' => $categories->count(),
        'courses' => $courses->count(),
        'countries' => $countries->count(),
        'cities' => $cities->count(),
        'chartjs' => $chartjs,
        'chartjs2' => $chartjs2
        ]);
        
    }

    //genrating random color
    private function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
    
    private function random_color() {
        return '#' . $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }
}
