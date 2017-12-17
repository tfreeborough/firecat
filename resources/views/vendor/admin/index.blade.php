@extends('app')

@section('title', 'Organisation Administration')

@extends('_partials.authenticated.account_bar')
@extends('_partials.vendor_menu')

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
        <div class="row">
            <div class="col-xs-12">
                Magic Link: <input type="text" value="{{ route('magic-link',$vendor->id) }}" size="80" />
            </div>
        </div>
        <div id="vendor-admin-stats-wrapper">
            <div id="vendor-admin-stats">
                <div id="square1" class="statistic box">
                    <div>
                        <div class="big">{{ number_format($vendor->memberCount()) }}</div>
                        <div class="small">Users</div>
                    </div>
                </div>
                <div id="square2" class="statistic box">
                    <div>
                        <div class="big">{{ number_format(count($vendor->opportunities)) }}</div>
                        <div class="small">Opportunities</div>
                    </div>

                </div>
                <div id="square3" class="statistic box">
                    <div>
                        <div class="big">{{ number_format(count($vendor->deals)) }}</div>
                        <div class="small">Deals</div>
                    </div>
                </div>
                <div id="square4" class="statistic box">
                    <div id="action-grid">
                        <div class="action">

                            <a href="{{route('vendor.admin.onboarding')}}">
                                <button class="button action">
                                    Onboarding
                                </button>
                            </a>
                        </div>
                        <div class="action">
                            <a href="{{route('vendor.admin.onboarding')}}">
                                <button class="button action">
                                    User Management
                                </button>
                            </a>
                        </div>
                        <div class="action">
                            <a href="{{route('vendor.admin.onboarding')}}">
                                <button class="button action">
                                    Notices
                                </button>
                            </a>
                        </div>
                        <div class="action">
                            <a href="{{route('vendor.admin.onboarding')}}">
                                <button class="button action">
                                    Organisation Settings
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="column1" class="statistic">
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
                <div id="column2" class="statistic">
                    <h4 class="title">Notices</h4>
                    <div id="notice-list">
                        <p><i>Notices coming soon...</i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection