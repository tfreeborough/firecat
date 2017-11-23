@extends('app')

@section('title', 'Tags')

@extends('_partials.authenticated.account_bar')
@extends('_partials.vendor_menu')

@section('content')
    <div id="vendor-tags">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">{{ $user->organisation->name }} tags</h1>
            <h5 id="page-subtitle">All tags used by {{ $user->organisation->name }}</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('vendor.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        Tags
                    </li>
                </ul>
            </div>
        </div>
        @include('_partials.flash_message')
        <div id="vendor-tags-wrapper">
            <table id="vendor-tags-table" class="table">
                <thead>
                <tr>
                    <th>Tag</th>
                    <th>Used</th>
                </tr>
                </thead>
                <tbody>
                @foreach($organisation_tags as $tag)
                    <tr>
                        <td>
                            <a href="{{ route('vendor.tags.tag',$tag->id) }}">
                                <div class="tag" style="color: {{$tag->text_color}}; background: {{$tag->color}}">{{ $tag->name }}</div>
                            </a>
                        </td>
                        <td>
                            {{ count($tag->deal_tags()->get()) }}
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
        $('#vendor-tags-table').DataTable();
    </script>
@endsection