@extends('app')

@section('title', 'Organisation Administration')

@section('content')
    <div id="page-topper">
        <div id="page-topper-bg"></div>
        <h1 id="page-title">Administration</h1>
        <h5 id="page-subtitle">Administration for {{ $vendor->name }}</h5>
        <div id="page-topper-breadcrumbs">
            <ul>
                <li>
                    <a href="{{route('vendor.dashboard')}}">
                        Dashboard
                    </a>
                </li>
                <li>
                    Administration
                </li>
            </ul>
        </div>
    </div>
    <div id="vendor-admin">
        <div id="vendor-admin-stats-wrapper">
            <div id="vendor-admin-stats">
                <div id="magic" class="block">
                    <h3 class="title">Magic Link</h3>
                    <div class="alert alert-info">
                        <p>
                            Your magic link is designed to help funnel more opportunities to you. By directing users to the
                            magic link, all of your details will be passed into the opportunity automatically, so the user only
                            needs to worry about the content of the opportunity, not if it is going to the right person.
                        </p>
                        <p>
                            <strong>Your magic link is: </strong><span class="highlight">{{ route('magic-link',$vendor->id) }}</span>
                        </p>
                    </div>
                </div>
                <div id="square1" class="dashboard-panel">
                    <div class="dashboard-panel-wrapper">
                        <div class="dashboard-panel-big">
                            {{ number_format($vendor->memberCount()) }}
                        </div>
                        <div class="dashboard-panel-small">
                            Users
                        </div>
                    </div>
                </div>
                <div id="square2" class="dashboard-panel">
                    <div class="dashboard-panel-wrapper">
                        <div class="dashboard-panel-big">
                            {{ number_format(count($vendor->opportunities)) }}
                        </div>
                        <div class="dashboard-panel-small">
                            Opportunities
                        </div>
                    </div>
                </div>
                <div id="square3" class="dashboard-panel">
                    <div class="dashboard-panel-wrapper">
                        <div class="dashboard-panel-big">
                            {{ number_format(count($vendor->deals)) }}
                        </div>
                        <div class="dashboard-panel-small">
                            Deals
                        </div>
                    </div>
                </div>
                <div id="square4" class="dashboard-panel">
                    <div class="dashboard-panel-wrapper">
                        <div class="dashboard-panel-big">
                            <span class="green">{{ number_format($deals_won) }}</span>/<span class="red">{{ number_format($deals_lost) }}</span>
                        </div>
                        <div class="dashboard-panel-small">
                            Deals Won/Lost
                        </div>
                    </div>
                </div>
                <div id="square5" class="block">
                    <h4 class="title">Administrators</h4>
                    <div id="admin-list">
                        @foreach($vendor->administrators as $administrator)
                            <div class="user">
                                <div class="avatar">
                                    <img src="{{ $administrator->user->getAvatar() }}" />
                                </div>
                                <div class="information">
                                    <div><strong>{{ $administrator->user->name() }}</strong></div>
                                    <div><span class="email">{{ $administrator->user->email }}</span></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="square6" class="block">
                    <h4 class="title">Administration Tools</h4>
                    <ul>
                        <li>
                            <a href="{{route('vendor.admin.onboarding')}}">
                                Onboarding
                            </a>
                        </li>
                        <li>
                            <a href="{{route('vendor.admin.tags')}}">
                                Organisation Tags
                            </a>
                        </li>
                        <li>
                            <a href="{{route('vendor.admin.users')}}">
                                Users
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection