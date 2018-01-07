@extends('app')

@section('title', 'My Dashboard')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Deals</h1>
            <h5 id="page-subtitle">Pending and completed deals for {{ $organisation->name }}.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('vendor.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        Deals
                    </li>
                </ul>
            </div>
        </div>
        @include('_partials.flash_message')
        <div id="vendor-deals">
            <div class="row">
                <div class="col-xs-12">
                    <table id="vendor-deals-table" class="table">
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th>Implementation Date</th>
                            <th>Deal Name</th>
                            <th>End Users Sector</th>
                            <th>Tags</th>
                            <th>Assigned</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deals as $deal)
                            <tr
                                class="@if($deal->status->pending)
                                        pending
                                    @else
                                @if($deal->status->won)
                                        won
                                    @else
                                        lost
                                    @endif
                                @endif"
                            >
                                <td>
                                    @if($deal->status->pending)
                                        Pending
                                    @else
                                        @if($deal->status->won)
                                            Won
                                        @else
                                            Lost
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($deal->opportunity->implementation_date)->format('d M Y') }}
                                </td>
                                <td>
                                    @if(Auth::user()->isAssigned($deal->opportunity_id))
                                        <a href="/vendor/deals/{{$deal->id}}">
                                            {{ $deal->opportunity->name }}
                                        </a>
                                    @else
                                        {{ $deal->opportunity->name }}
                                    @endif

                                    @if($deal->reference)
                                        <small>({{$deal->reference}})</small>
                                    @endif
                                </td>
                                <td>{{ $deal->opportunity->endUser->organisation_type }}</td>
                                <td>
                                    @foreach($deal->tags as $tag)
                                        <a href="{{ route('vendor.tags.tag',$tag->organisation_tag->id)}}">
                                            <div class="tag" style="color: {{$tag->organisation_tag->text_color}}; background: {{$tag->organisation_tag->color}}">{{ $tag->organisation_tag->name }}</div>
                                        </a>
                                    @endforeach
                                    <small><span><a href="/vendor/deals/{{$deal->id}}/tag"><i class="fa fa-pencil" aria-hidden="true"></i></a></span></small>
                                </td>
                                <td>
                                    <ul>
                                        @foreach($deal->opportunity->assignees as $assignee)
                                            <li>
                                                <img src="{{ $assignee->user->getAvatar() }}" />
                                            </li>
                                        @endforeach
                                        @if(count($deal->opportunity->assignees) === 0)
                                            <li>
                                                Nobody has been assigned so far
                                            </li>
                                        @endif
                                    </ul>
                                </td>
                                <td>
                                    <a href="/vendor/deals/{{$deal->id}}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#vendor-deals-table').DataTable();
    </script>
@endsection