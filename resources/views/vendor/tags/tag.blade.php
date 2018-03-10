@extends('app')

@section('title', $tag->name)

@section('content')
    <div id="vendor-tag">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">{{ $tag->name }}</h1>
            <h5 id="page-subtitle">All deals with tagged with <div class="tag" style="color: {{$tag->text_color}}; background: {{$tag->color}}">{{ $tag->name }}</div></h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('vendor.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('vendor.tags')}}">
                            Tags
                        </a>
                    </li>
                    <li>
                        {{ $tag->name }}
                    </li>
                </ul>
            </div>
        </div>
        @include('_partials.flash_message')
        <div id="vendor-tag-wrapper">
            <table id="vendor-tag-table" class="table">
                <thead>
                <tr>
                    <th>Status</th>
                    <th>Deal Name</th>
                    <th>End Users Sector</th>
                    <th>Assigned</th>
                    <th>Converted On</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($deal_tags as $deal_tag)
                <tr class="@if($deal_tag->deal->status->pending)
                            pending
                        @else
                    @if($deal_tag->deal->status->won)
                            won
                        @else
                            lost
                        @endif
                    @endif">
                        <td>
                            @if($deal_tag->deal->opportunity->status->getStatusCode() === 4)
                                Accepted
                            @else
                                Rejected
                            @endif
                        </td>
                        <td>
                            <a href="/vendor/deals/{{$deal_tag->deal->id}}">
                                {{ $deal_tag->deal->opportunity->name }}
                            </a>
                            @if($deal_tag->deal->reference)
                                <small>({{$deal_tag->deal->reference}})</small>
                            @endif
                        </td>
                        <td>{{ $deal_tag->deal->opportunity->endUser->organisation_type }}</td>
                        <td>
                            <ul>
                                @foreach($deal_tag->deal->opportunity->assignees as $assignee)
                                    <li>
                                        <img title="{{ $assignee->user->first_name }} {{ $assignee->user->last_name }}" src="{{ $assignee->user->getAvatar() }}" />
                                    </li>
                                @endforeach
                                @if(count($deal_tag->deal->opportunity->assignees) === 0)
                                    <li>
                                        Nobody has been assigned so far
                                    </li>
                                @endif
                            </ul>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($deal_tag->deal->created_at)->format('d-m-y @ h:ma') }}
                        </td>
                        <td>
                            <a href="/vendor/deals/{{$deal_tag->deal->id}}">
                                <i class="fa fa-chain-broken" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
    </script>
@endsection