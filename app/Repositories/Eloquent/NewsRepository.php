<?php

namespace App\Repositories\Eloquent;

use App\Models\News;
use App\Repositories\Interfaces\NewsRepositoryInterface;

class NewsRepository implements NewsRepositoryInterface {

    public function getAll()
    {
        $data['news'] = News::all();

        return view('news.index')->with($data);
        
    }
}