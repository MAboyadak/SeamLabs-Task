<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProblemTwoController extends Controller
{
    private string $input_string;
    private int $result = 0;

    private array $charMapping = [
        'a' => 1,'b' => 2,'c' => 3,'d' => 4,'e' => 5,'f' => 6,'g' => 7,'h' => 8,'i' => 9,
        'j' => 10,'k' => 11,'l' => 12,'m' => 13,'n' => 14,'o' => 15,'p' => 16,'q' => 17,
        'r' => 18,'s' => 19,'t' => 20,'u' => 21,'v' => 22,'w' => 23,'x' => 24,'y' => 25,'z' => 26,
    ];


    public function __construct(Request $request)
    {
        $this->input_string = $request->input_string;
    }

    public function getIndex($ch, $pos){
        return 26 ** $pos * $this->charMapping[strtolower($ch)];
    }

    public function __invoke()
    {
        // if(preg_match('/[a-zA-Z]/', $this->input_string) != 1){
        //     return response()->json([
        //         'status'    => false,
        //         'message'   => 'Input Must be of type string'
        //     ]);
        // }

        if(!ctype_alpha($this->input_string)){
            return response()->json([
                'status'    => false,
                'message'   => 'Input Must be of type string'
            ]);
        }

        $arrOfString = str_split($this->input_string);
        $pos = 0;
        for($i=count($arrOfString)-1; $i>=0; $i--){
            $this->result += $this->getIndex($arrOfString[$i], $pos);
            $pos++;
        }

        return $this->result;
    }
}
