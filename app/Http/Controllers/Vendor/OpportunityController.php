<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/06/2017
 * Time: 00:27
 */

namespace App\Http\Controllers\Vendor;


use App\Events\CreateOpportunityActivity;
use App\Http\Controllers\Controller;
use App\Mail\partner\VendorSentThreadMessage;
use App\Models\Assignee;
use App\Models\Deal;
use App\Models\DealStatus;
use App\Models\Opportunity;
use App\Models\OpportunityConsideration;
use App\Models\OpportunityMessage;
use App\Models\OpportunityThread;
use App\Models\OpportunityThreadMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class OpportunityController extends Controller
{


    /**
     * @param $uuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function showOpportunity($uuid)
    {
        if(Auth::user()->organisation->hasOpportunity($uuid)){
            return view('vendor.opportunities.opportunity', [
                'opportunity' => Opportunity::find($uuid),
                'user' => Auth::user()
            ]);
        }
        return abort(404);

    }

    /**
     * @param $uuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function showThreads($uuid)
    {
        if(Auth::user()->organisation->hasOpportunity($uuid)){
            return view('vendor.opportunities.threads', [
                'opportunity' => Opportunity::find($uuid),
                'user' => Auth::user()
            ]);
        }
        return abort(404);

    }
    
    public function postCreateThread($uuid, Request $request)
    {
        if(Auth::user()->organisation->hasOpportunity($uuid)){
            if(Auth::user()->isAssigned($uuid)){
                Validator::make($request->all(), [
                    'subject' => 'required|string',
                ])->validate();

                $thread = new OpportunityThread();
                $thread->subject = $request->get('subject');
                $thread->opportunity_id = $uuid;
                $thread->user_id = Auth::user()->id;
                $thread->save();
                
                event(new CreateOpportunityActivity(
                    $thread->opportunity,
                    Auth::user(),
                    Auth::user()->first_name.' '.Auth::user()->last_name.' created a new thread called \''.$thread->subject.'\'.'
                ));

                return response(200);
            }
        }
        return abort(404);
    }

    public function postNewThreadMessage($uuid, Request $request)
    {
        if(Auth::user()->organisation->hasOpportunity($uuid)){
            if(Auth::user()->isAssigned($uuid)){
                Validator::make($request->all(), [
                    'message' => 'required|string',
                    'thread' => 'required|string'
                ])->validate();

                $message = new OpportunityThreadMessage();
                $message->message = $request->get('message');
                $message->opportunity_thread_id = $request->get('thread');
                $message->user_id = Auth::user()->id;
                $message->save();

                $thread = OpportunityThread::find($request->get('thread'));
                Mail::to($thread->opportunity->partner->email)
                    ->queue(new VendorSentThreadMessage($message, $thread->opportunity->partner));
                
                return response(200);
            }
        }
        return abort(404);
    }


    /**
     * @param $uuid
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     * @throws \Exception
     */
    public function assignOpportunity($uuid)
    {
        if(Auth::user()->organisation->hasOpportunity($uuid)){
            if(!Auth::user()->isAssigned($uuid)){
                $opportunity = Opportunity::find($uuid);

                if(count($opportunity->assignees) === 0){
                    $opportunity->status->associated = true;
                    $opportunity->status->save();

                    event(new CreateOpportunityActivity(
                        $opportunity,
                        Auth::user(),
                        Auth::user()->first_name.' '.Auth::user()->last_name.' set '.$opportunity->name.' to \'Associated\'.'
                    ));
                }

                $assignee = new Assignee();
                $assignee->id = Uuid::generate();
                $assignee->opportunity_id = $uuid;
                $assignee->user_id = Auth::user()->id;
                $assignee->save();

                event(new CreateOpportunityActivity(
                    $opportunity,
                    Auth::user(),
                    Auth::user()->first_name.' '.Auth::user()->last_name.' assigned themselves to '.$opportunity->name.'.'
                ));


                return redirect('/vendor/opportunities/'.$uuid);
            }else{
                return redirect('/vendor/opportunities/'.$uuid)->withErrors([
                    'You are already assigned to this opportunity'
                ]);
            }
        }
        return abort(404);
    }


    /**
     * @param $uuid
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function reviewOpportunity($uuid)
    {
        if(Auth::user()->organisation->hasOpportunity($uuid)){
            if(Auth::user()->isAssigned($uuid)){
                $opportunity = Opportunity::find($uuid);
                if(!$opportunity->status->in_review){
                    $opportunity->status->in_review = true;
                    $opportunity->status->save();

                    event(new CreateOpportunityActivity(
                        $opportunity,
                        Auth::user(),
                        Auth::user()->first_name.' '.Auth::user()->last_name.' set '.$opportunity->name.' to \'In Review\'.'
                    ));

                    return redirect('/vendor/opportunities/'.$uuid);
                }else{
                    return redirect('/vendor/opportunities/'.$uuid)->withErrors([
                        'This opportunity is already in review'
                    ]);
                }
            }
        }
        return abort(404);
    }

    /**
     * @param $uuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function showMessages($uuid)
    {
        if(Auth::user()->organisation->hasOpportunity($uuid)){
            if(Auth::user()->isAssigned($uuid)){
                return view('vendor.opportunities.opportunity_messages', [
                    'opportunity' => Opportunity::find($uuid),
                    'user' => Auth::user()
                ]);
            }
        }
        return abort(404);
    }

    /**
     * @param $uuid
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response|void
     * @throws \Exception
     */
    public function postMessage($uuid, Request $request)
    {
        if(Auth::user()->organisation->hasOpportunity($uuid)){
            if(Auth::user()->isAssigned($uuid)){
                Validator::make($request->all(), [
                    'message' => 'required|string',
                ])->validate();
                $message = $request->get('message');

                $newMessage = new OpportunityMessage();
                $newMessage->id = Uuid::generate();
                $newMessage->user_id = Auth::user()->id;
                $newMessage->opportunity_id = $uuid;
                $newMessage->message = $message;
                $newMessage->save();

                $opportunity = Opportunity::find($uuid);

                event(new CreateOpportunityActivity(
                    $opportunity,
                    Auth::user(),
                    Auth::user()->first_name.' '.Auth::user()->last_name.' sent a message to '.$opportunity->name.'.',
                    '/vendor/opportunities/'.$opportunity->id.'/messages#'.$newMessage->id
                ));

                return response(200);
            }
        }
        return abort(404);
    }

    /**
     * @param $uuid
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response|void
     * @throws \Exception
     */
    public function postConvert($uuid, Request $request)
    {
        if(Auth::user()->organisation->hasOpportunity($uuid)){
            if(Auth::user()->isAssigned($uuid)){
                $opportunity = Opportunity::find($uuid);
                if($opportunity->getConsiderationsCompleted() === count($opportunity->considerations)){
                    if($opportunity->status->in_review){
                        $deal_id = Uuid::generate();
                        $deal = new Deal();
                        $deal->id = $deal_id;
                        $deal->opportunity_id = $uuid;
                        $deal->save();
                        
                        $opportunity->status->accepted = true;
                        $opportunity->status->save();
                        
                        $deal_status = new DealStatus();
                        $deal_status->pending = true;
                        $deal_status->won = false;
                        $deal_status->deal_id = $deal->id;
                        $deal_status->save();

                        event(new CreateOpportunityActivity(
                            $opportunity,
                            Auth::user(),
                            Auth::user()->first_name.' '.Auth::user()->last_name.' converted '.$opportunity->name.' into a deal.',
                            '/vendor/deals/'.$deal_id
                        ));
                        return response(200);
                    }
                    return response('This opportunity cannot be converted into a deal until it has gone under review.', 400);
                }else{
                    return response('Not all considerations have been achieved, please attempt to convert this opportunity once they are completed.', 400);
                }
            }
        }
        return abort(404);
    }

    public function markConsiderationComplete($uuid, $consideration_id)
    {
        if(Auth::user()->organisation->hasOpportunity($uuid)){
            if(Auth::user()->isAssigned($uuid)){
                $consideration = OpportunityConsideration::find($consideration_id);
                if($consideration !== null && $consideration->opportunity->id === $uuid){
                    $consideration->achieved = true;
                    $consideration->save();

                    event(new CreateOpportunityActivity(
                        Opportunity::find($uuid),
                        Auth::user(),
                        Auth::user()->name().' marked a consideration as complete.',
                        null
                    ));

                    return redirect(route('vendor.opportunity',$uuid));
                }
                return redirect(route('vendor.opportunity',$uuid))->withErrors([
                    'The consideration does not belong to this opportunity.'
                ]);
            }
        }
        return abort(404);
    }

}