<?php

/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/06/2017
 * Time: 15:42
 */
namespace App\Http\Controllers\Docs;

use App\Http\Controllers\Controller;

class OpportunitiesController extends Controller
{

    public function index()
    {
        return view('docs.opportunities.index');
    }

    public function statuses()
    {
        return view('docs.opportunities.statuses');
    }
}