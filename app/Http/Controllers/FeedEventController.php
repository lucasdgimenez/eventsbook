<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Image;

class FeedEventController extends Controller
{
    private $loggedUser;

    public function __construct() {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
    }

    public function read(Request $request) {
        $array = ['error' => ''];

        $page = intval($request->input('page'));
        $perPage = 2;

        $eventList = Event::all();
        $array['events'] = $eventList;

        /*
        foreach ($userList as $userItem) {
            $users[] = $userItem['user_to'];
        }
        $users[] = $this->loggedUser['id'];

        //2. Pegar posts ordenado pela data
        $postList = Post::whereIn('id_user', $users)
        ->offset($page * $perPage)
        ->limit($perPage)
        ->orderBy('created_at', 'desc')
        ->get();

        $total = Post::whereIn('id_user', $users)->count();
        $pageCount = ceil($total / $perPage);

        //3. Preencher as informações adicionais
        $posts = $this->_postListToObject($postList, $this->loggedUser['id']);

        $array['posts'] = $posts;
        $array['pageCount'] = $pageCount;
        $array['currentPage'] = $page;*/

        return $array;
    }

    public function eventItem(Request $request, $id) {
        $array = ['error' => ''];

        $page = intval($request->input('page'));
        $perPage = 2;

        $eventsList = Event::where('id', $id)
        ->orderBy('date_event', 'desc')
        ->offset($page * $perPage)
        ->limit($perPage)
        ->get();

        $total = Event::where('id', $id)->count();
        $pageCount = ceil($total / $perPage);

        if($total === 0) {
            $array['error'] = 'Nenhum evento encontrado';
            $array['events'] = $eventsList;
            return $array;
        }

        $array['events'] = $eventsList;
        $array['pageCount'] = $pageCount;
        $array['currentPage'] = $page;

        return $array;
    }

    public function create(Request $request) {
        $array = ['error' => ''];

        $name = $request->input('name');
        $type = $request->input('type');
        $date_event = $request->input('date_event');
        $cover = $request->file('cover');
        $description = $request->input('description');

        //if($name && $type && $date_event && $description) {
            $newEvent = new Event();
            $newEvent->name = $name;
            $newEvent->type = $type;
            $newEvent->date_event = $date_event;
            $newEvent->description = $description;
        /*} else {
            $array['error'] = 'Dados não enviados';
            return $array;
        }*/

        $filename = md5(time().rand(0,9999)).'.jpg';
        $destPath = public_path('/media/cover');
        $img = Image::make($cover->path())
            ->resize(800, null, function($constraint) {
                //mantenha a proporção
                $constraint->aspectRatio();
            })
            ->save($destPath.'/'.$filename);
        
        $newEvent->cover = $filename;
        $newEvent->save();
        $array['events'] = $newEvent;

        return $array;
    }
}
