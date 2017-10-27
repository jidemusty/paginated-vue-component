<?php

namespace App\Http\Controllers;

use App\Transformers\TopicTransformer;
use Illuminate\Http\Request;
use App\Topic;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::latestFirst()->paginate(7);
        $topicsCollection = $topics->getCollection();

        return fractal()
            ->collection($topicsCollection)
            ->parseIncludes(['user'])
            ->transformWith(new TopicTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($topics))
            ->toArray();
    }
}
