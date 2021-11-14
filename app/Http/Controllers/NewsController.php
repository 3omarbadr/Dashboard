<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\NewsRepositoryInterface;

class NewsController extends Controller
{
    private $repository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->repository = $newsRepository;
    }

    public function index()
    {
        return $this->repository->getAll();
    }
}
