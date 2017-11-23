<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 23/11/2017
 * Time: 21:07
 */

namespace App\Http\Controllers\Vendor;


use App\Http\Controllers\Controller;
use App\Models\OrganisationTag;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{


    public function index()
    {
        return view('vendor.tags.index')->with([
            'organisation_tags' => OrganisationTag::where('organisation_id','=',Auth::user()->organisation->id)->get(),
            'user' => Auth::user()
        ]);
    }

    public function show($tag_id)
    {
        $organisation_tag = OrganisationTag::find($tag_id);
        $deal_tags = $organisation_tag->deal_tags;
        return view('vendor.tags.tag')->with([
            'tag' => $organisation_tag,
            'deal_tags' => $deal_tags
        ]);
    }

}