<?php

namespace App\Http\Controllers\Vendor\Admin;


use App\Http\Controllers\Controller;
use App\Models\OrganisationTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{


    public function showTags()
    {
        return view('vendor.admin.tags')->with([
           'tags' => Auth::user()->organisation->tags
        ]);
    }

    public function showTagPage($tag_id)
    {
        return view('vendor.admin.tag')->with([
            'tag' => OrganisationTag::find($tag_id)
        ]);
    }
    
    public function updateTagTextColor(Request $request, $tag_id)
    {
        Validator::make($request->all(), [
            'tag_text_color' => 'required|string'
        ])->validate();
        $organisation_tag = OrganisationTag::find($tag_id);
        $organisation_tag->text_color = $request->get('tag_text_color');
        $organisation_tag->save();

        return back()->with([
            'alert-success' => 'Tag text color has been successfully updated.'
        ]);
    }

    public function updateTagBackgroundColor(Request $request, $tag_id)
    {
        Validator::make($request->all(), [
            'tag_background_color' => 'required|string'
        ])->validate();
        $organisation_tag = OrganisationTag::find($tag_id);
        $organisation_tag->color = $request->get('tag_background_color');
        $organisation_tag->save();

        return back()->with([
            'alert-success' => 'Tag background color has been successfully updated.'
        ]);
    }

    public function updateTagName(Request $request, $tag_id)
    {
        Validator::make($request->all(), [
            'tag_name' => 'required|string'
        ])->validate();

        if(OrganisationTag::where([
                    ['name','=',$request->get('tag_name')],
                    ['organisation_id', '=', Auth::user()->organisation->id]
                ])->first() === null){
            $organisation_tag = OrganisationTag::find($tag_id);
            $organisation_tag->name = $request->get('tag_name');
            $organisation_tag->save();

            return back()->with([
                'alert-success' => 'Tag name has been successfully updated.'
            ]);
        }
        return back()->withErrors([
            'A tag with that name already exists, please choose a different name'
        ]);
    }

    public function deleteTag(Request $request, $tag_id)
    {
        $organisation_tag = OrganisationTag::find($tag_id);
        $organisation_tag->deal_tags()->delete();
        $organisation_tag->delete();

        $request->session()->flash('alert-success', 'Tag successfully deleted.');
        return response(200);
    }


}