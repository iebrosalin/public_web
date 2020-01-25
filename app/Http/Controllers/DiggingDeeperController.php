<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiggingDeeperController extends Controller
{
    public function collections()
    {
        $result = [];

        /**
         * @var \Illuminate\Database\Eloquent\Collection $eloquentCollection
         */
        $eloquentCollection = BlogPost::withTrashed()->get();

//         dd(__METHOD__,
//             $eloquentCollection,
//             $eloquentCollection->toArray()
//         );

        /**
         * @var \Illuminate\Support\Collection $collection
         */
         $collection = collect($eloquentCollection->toArray());

//         dd(__METHOD__,
//            get_class($eloquentCollection),
//            get_class($collection),
//            $collection
//         );

//         $result ['first'] = $collection->first();
//         $result ['last']  = $collection->last();
//
//         dd(__METHOD__,
//             $result
//         );

        $result['where'] ['data'] = $collection
            ->where('category_id', 10)
            ->values()
            ->keyBy('id');
//
//         dd(__METHOD__,
//             $result
//         );

         $result ['where'] ['count'] = $result ['where'] ['data']->count();
         $result ['where'] ['isEmpty'] = $result ['where'] ['data']->isEmpty();
         $result ['where'] ['isNotEmpty'] = $result ['where'] ['data']->isNotEmpty();

//        dd(__METHOD__,
//            $result
//        );


        $result['where_first'] = $collection
            ->firstWhere('created_at','>','2019-01-23 00:00:00');
//
//        dd(__METHOD__,
//        $result
//    );


        $result ['map'] ['all'] = $collection->map(
            function(array $item) {
                $newItem= new \stdClass();
                $newItem->item_id = $item['id'];
                $newItem->item_title = $item['title'];
                $newItem->exists = is_null($item['deleted_at']);

                return $newItem;
            }
        );
//
//        dd(__METHOD__,
//            $result
//        );

        $result ['map'] ['not_exists'] = $result ['map'] ['all']
            ->where('exists','=',false)
            ->values()
            ->keyBy('id');


        $collection->transform(function(array  $item) {
            $newItem= new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_title = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            $newItem->created_at = Carbon::parse($item['created_at']);

            return $newItem;
        });

//        dd(__METHOD__,
//            $collection
//        );

//        $newItem = new \stdClass();
//        $newItem->id = 999;
//
//        $newItem2 = new \stdClass();
//        $newItem2->id = 222;
//
//        $newItemFirst = $collection->prepend($newItem)->first();
//        $newItemLast = $collection->push($newItem)->last();
//        $pulledItem = $collection->pull(1);
//
//        dd(compact('collection','newItemFirst', 'newItemLast', 'pulledItem'));


        $filtered = $collection->filter(function($item){
            $byDay = $item->created_at->isFriday();
            $byDate = $item->created_at->day == 11;

            $result = $byDate && $byDay;

            return $result;
        });

//        dd(compact('filtered'));

        $sortedSimpleCollection = collect([5,3,1,2,4])->sort();
        $sortedAscCollection = $collection->sortBy('created_at');
        $sortedDescCollection = $collection->sortByDesc('item_id');

        dd(compact(
            'sortedSimpleCollection',
                'sortedAscCollection',
                'sortedDescCollection'
            )
        );
    }
}
