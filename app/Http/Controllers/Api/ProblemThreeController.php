<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProblemThreeController extends Controller
{
    private $q;
    private $result = [];
    private $stepsCount = 0;

    //
    // I searched to understand the problem itself,
    // I understood it and i found that it requires knowledge of Dynamic Programming Algorithms
    // I watched two videos on youtube which solves almost similar problem from leetcode
    // but i am sorry that the time was not enough for me to understand the algorithm correctly
    // as i was busy with some personal thing,
    // i didn't want to solve it in a random solution or copy it form anywhere to just be solved
    // while i don't understand the algorithm itself
    // but if have enough time i can understand it properly and solve it in the future
    // Thanks. //
    //


    public function getMinSteps($n,$q){

        // function minmize($x){
        //     if( is_int(sqrt($x)) ){
        //         return sqrt($x);
        //     }elseif()
        // }

        // for($i=0; $i < $n; $i++){

        //     minmize($q[$i]);

        // }
    }





    public function __invoke(Request $request)
    {
        $this->q = $request->q;
        $this->getMinSteps( count($this->q), $this->q );
    }
}
