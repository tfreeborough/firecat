@extends('app')

@section('title', 'Organisation Administration')

@section('content')
    <div id="page-topper">
        <div id="page-topper-bg"></div>
        <h1 id="page-title">Organisation Tag Administration</h1>
        <h5 id="page-subtitle">Manage Tags within your Organisation</h5>
        <div id="page-topper-breadcrumbs">
            <ul>
                <li>
                    <a href="{{route('vendor.dashboard')}}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{route('vendor.admin')}}">
                        Administration
                    </a>
                </li>
                <li>
                    Tags
                </li>
            </ul>
        </div>
    </div>
    <div id="vendor-admin-tags">
        @include('_partials.flash_message')
        <table id="vendor-admin-tags-table" class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Tagged Deals</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>
                        <a href="{{ route('vendor.admin.tags.tag',$tag->id) }}">
                            <div class="tag" style="color: {{$tag->text_color}}; background: {{$tag->color}}">{{ $tag->name }}</div>
                        </a>
                    </td>
                    <td>{{ count($tag->deal_tags) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>
        $('#vendor-admin-tags-table').DataTable();
    </script>
@endsection