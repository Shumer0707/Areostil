<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke()
    {
        $persons = [
            [
                'name'=>'Bob',
                'age'=> 40,
            ],
            [
                'name'=>'Goga',
                'age'=> 17,
            ]
        ];

        return $persons;
    }
}
