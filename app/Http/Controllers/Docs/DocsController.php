<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/06/2017
 * Time: 15:50
 */

namespace App\Http\Controllers\Docs;


class DocsController
{

    public function index()
    {
        return view('docs.index');
    }

}