@extends('app')

@section('title', $partner->first_name.' '.$partner->last_name)

@extends('_partials.authenticated.account_bar')
@extends('_partials.admin_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Partner - {{ $partner->first_name }} {{ $partner->last_name }}</h1>
            <h5 id="page-subtitle">View information about {{ $partner->first_name }}.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('admin.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.partners')}}">
                            Partner Management
                        </a>
                    </li>
                    <li>
                        Partner - {{ $partner->first_name }} {{ $partner->last_name }}
                    </li>
                </ul>
            </div>
        </div>
        <div id="create_partner">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-xs-12">
                        <div id="login-errors" class="text-left">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{!! $error !!}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">

                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <p>Deals: {{ count($partner->deals) }}</p>
                    <table id="partner-deals" class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($partner->deals as $deal)
                                <tr>
                                    <td>{{ $deal->name }}</td>
                                    <td>{{ $deal->information->status }}</td>
                                    <td>{{ $deal->created_at }}</td>
                                    <td>&nbsp;</td>
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
        $('#partner-deals').DataTable();
    </script>
@endsection