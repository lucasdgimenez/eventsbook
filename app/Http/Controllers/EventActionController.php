<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventInterestList;
use App\Models\EventWillGo;
use App\Models\EventFavorite;
use App\Models\EventLike;

class EventActionController extends Controller
{
    private $loggedUser;

    public function __construct() {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
    }

    public function eventAction(Request $request, $nameAction, $action, $id) {
        $array = ['error' => ''];

        if($nameAction == 'EventInterestList') {
            switch ($action) {
                case 'add':
                    $itemEventInterestList = new EventInterestList();
                    $itemEventInterestList->id_user = $this->loggedUser->id;
                    $itemEventInterestList->id_event = $id;
                    $itemEventInterestList->save();
                    
                    $array['eventInterestList'] = $itemEventInterestList;
                    break;
                case 'delete':
                    
                    $itemEventInterestList = EventInterestList::select(
                            'id', 'id_event', 'id_user'
                        )->where('id_user', $this->loggedUser->id)
                         ->where('id_event', $id)->get();
                    
                    EventInterestList::where('id',$itemEventInterestList[0]->id)->delete();

                    break;
                default:
                    # code...
                    break;
            }
        }

        if($nameAction == 'EventWillGo') {
            switch ($action) {
                case 'add':
                    $itemEventWillGo = new EventWillGo();
                    $itemEventWillGo->id_user = $this->loggedUser->id;
                    $itemEventWillGo->id_event = $id;
                    $itemEventWillGo->save();
                    
                    $array['eventInterestList'] = $itemEventWillGo;
                    break;
                case 'delete':
                    
                    $itemEventWillGo = EventInterestList::select(
                            'id', 'id_event', 'id_user'
                        )->where('id_user', $this->loggedUser->id)
                         ->where('id_event', $id)->get();
                    
                    EventInterestList::where('id',$itemEventWillGo[0]->id)->delete();

                    break;
                default:
                    # code...
                    break;
            }
        }

        if($nameAction == 'EventFavorite') {
            switch ($action) {
                case 'add':
                    $itemEventFavorite = new EventInterestList();
                    $itemEventFavorite->id_user = $this->loggedUser->id;
                    $itemEventFavorite->id_event = $id;
                    $itemEventFavorite->save();
                    
                    $array['eventInterestList'] = $itemEventFavorite;
                    break;
                case 'delete':
                    
                    $itemEventFavorite = EventInterestList::select(
                            'id', 'id_event', 'id_user'
                        )->where('id_user', $this->loggedUser->id)
                         ->where('id_event', $id)->get();
                    
                    EventInterestList::where('id',$itemEventFavorite[0]->id)->delete();

                    break;
                default:
                    # code...
                    break;
            }
        }

        if($nameAction == 'EventLike') {
            switch ($action) {
                case 'add':
                    $itemEventLike = new EventLike();
                    $itemEventLike->id_user = $this->loggedUser->id;
                    $itemEventLike->id_event = $id;
                    $itemEventLike->save();
                    
                    $array['eventInterestList'] = $EventLike;
                    break;
                case 'delete':
                    
                    $EventLike = EventInterestList::select(
                            'id', 'id_event', 'id_user'
                        )->where('id_user', $this->loggedUser->id)
                         ->where('id_event', $id)->get();
                    
                    EventInterestList::where('id',$EventLike[0]->id)->delete();

                    break;
                default:
                    # code...
                    break;
            }
        }

        return $array;
    }
}
