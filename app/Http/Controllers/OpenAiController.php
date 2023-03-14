<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class OpenAiController extends Controller
{

    public function index(){
        return view('index');
    }
    public function search(Request $request){

        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            // 'prompt' => 'what is your name',
            'prompt' => $request->prompt,
            'max_tokens' => 4000,
        ]);
        //  dd($result);
        return json_encode($result->choices[0]->text);

    }
}
