@extends('app')

@section('title', 'Onboarding')

@extends('_partials.authenticated.account_bar')
@extends('_partials.admin_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Onboarding</h1>
            <h5 id="page-subtitle">Manage, Edit and Add new Organisations to Firecat.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('admin.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        Onboarding
                    </li>
                </ul>
            </div>
        </div>
        <div id="onboarding">
            <a href="{{route('admin.onboarding.create')}}">
                <button class="button action">Create New Organisation <i class="fa fa-sitemap" aria-hidden="true"></i></button>
            </a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Organisation Name</th>
                        <th>Members</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($organisations as $organisation)
                        <tr>
                            <td><a href="{{ route('admin.onboarding.index',$organisation->id) }}">{{ $organisation->name }}</a></td>
                            <td>{{ $organisation->memberCount() }}</td>
                            <td>
                                <a href="/admin/onboarding/{{$organisation->id}}">
                                    <button class="button" title="View this organisation"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection