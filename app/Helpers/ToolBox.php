<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Html2Text\Html2Text;
abstract  class ToolBox
{
    static public function openAiKeyWord(string $strTextForKeyWord){
        $response=Http::withHeaders([
            'Authorization'=>'Bearer '.env('OPENAI_API_KEY'),
        ])->post('https://api.openai.com/v1/chat/completions',[
            'model' => 'gpt-3.5-turbo-instruct',
            'messages' => [
                ['role' => 'system', 'content' => '5 mots clés pour cet article : '],
                ['role' => 'user', 'content' => $strTextForKeyWord],
            ],

        ]);
        //$chatResponse= $response->json()['choices'][0]['text'];
        return $response->json();
    }
}
