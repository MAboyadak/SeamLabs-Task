<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProblemOneController extends Controller
{
    private int $start_number;
    private int $end_number;
    private int $count_of_fives = 0;
    private int $number;

    public function isNumber($number)
    {
        if(!is_numeric($number)){
            return false;
        }

        return true;
    }

    public function countOfFives($number){
        $this->number = abs($number);

        while($this->number > 0){
            if($this->number %10 == 5){
                $this->count_of_fives++;
                break;
            }
            $this->number = $this->number / 10;
        }
        return;
    }

    public function __invoke(Request $request){

        // validate the number type
        if(! $this->isNumber($request->start_number) || ! $this->isNumber($request->end_number)){

            return response()->json([
                'status'    => false,
                'message'   => 'Numbers Must be of type integer'
            ]);

        }

        $this->start_number = intval($request->start_number);
        $this->end_number = intval($request->end_number);

        for($i= $this->start_number; $i<=$this->end_number; $i++){
            $this->countOfFives($i);
        }

        return $this->end_number - $this->start_number - $this->count_of_fives + 1;
    }
}
