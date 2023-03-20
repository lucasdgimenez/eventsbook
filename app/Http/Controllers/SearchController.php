<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class SearchController extends Controller
{
    private $loggedUser;

    public function __construct() {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
    }

    public function search(Request $request) {
        $array = ['error' => '', 'users' => []];

        $txt = $request->input('txt');

        if($txt) {

            // Busca de eventos
            $eventList = Event::where('name', 'like', '%'.$txt.'%')->get();
            foreach ($eventList as $eventItem) {
                $array['events'][] = [
                    'id' => $eventItem['id'],
                    'name' => $eventItem['name']
                ];
            }

        } else {
            $array['error'] = 'Digite alguma coisa para buscar';
            return $array;
        }

        return $array;
    }
}
