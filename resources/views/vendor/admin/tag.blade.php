@extends('app')

@section('title', 'Organisation Administration')

@section('content')
    <div id="page-topper">
        <div id="page-topper-bg"></div>
        <h1 id="page-title">{{ $tag->name }}</h1>
        <h5 id="page-subtitle">Manage settings for the <div class="tag" style="color: {{$tag->text_color}}; background: {{$tag->color}}">{{ $tag->name }}</div> tag.</h5>
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
                    <a href="{{route('vendor.admin.tags')}}">
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
    <div id="vendor-admin-tag">
        <div id="vendor-admin-tag-options" class="block">
            <h2 class="title">Options</h2>
            <div id="vendor-admin-tag-options-wrap">
                <div id="tag-color-change" class="block">
                    <h4 class="title">Change tag text color</h4>
                    {!! Form::open(['url' => route('vendor.admin.tag.text_color',$tag->id)]) !!}
                    <div class="element">
                        {{ Form::label('tag_text_color', null, ['class' => 'control-label']) }}
                        {{ Form::text('tag_text_color', null, array_merge(['class' => 'form-control', 'id' => 'tag_text_color'])) }}
                    </div>
                    <div class="submit">
                        {{ Form::submit('Update Text Color', array_merge(['class' => 'button'])) }}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div id="tag-background-change" class="block">
                    <h4 class="title">Change tag background color</h4>
                    {!! Form::open(['url' => route('vendor.admin.tag.background_color',$tag->id)]) !!}
                    <div class="element">
                        {{ Form::label('tag_background_color', null, ['class' => 'control-label']) }}
                        {{ Form::text('tag_background_color', null, array_merge(['class' => 'form-control', 'id' => 'tag_background_color'])) }}
                    </div>
                    <div class="submit">
                        {{ Form::submit('Update Background Color', array_merge(['class' => 'button'])) }}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div id="tag-rename" class="block">
                    <h4 class="title">Rename tag</h4>
                    {!! Form::open(['url' => route('vendor.admin.tag.rename',$tag->id)]) !!}
                        <div class="element">
                            {{ Form::text('tag_name', $tag->name, array_merge(['class' => 'form-control'])) }}
                        </div>
                        <div class="submit">
                            {{ Form::submit('Update Name', array_merge(['class' => 'button'])) }}
                        </div>
                    {!! Form::close() !!}
                </div>
                <div id="tag-delete" class="block alert-danger">
                    <h4 class="title">Delete Tag</h4>
                    <div class="form">
                        <div class="element">
                            <p>Note: deleting this tag will remove it from all Deals it is assigned to.</p>
                        </div>
                        <div class="submit">
                            <button type="button" class="button" onClick="confirmTagDelete()">Delete Tag</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="vendor-admin-tag-deals" class="block">
            <h2 class="title">Tagged Deals ({{ count($tag->deal_tags) }})</h2>
            <table id="vendor-admin-tag-deals-table" class="table">
                <thead>
                <tr>
                    <th>Status</th>
                    <th>Implementation Date</th>
                    <th>Deal Name</th>
                    <th>End Users Sector</th>
                    <th>Assigned</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tag->deal_tags as $deal_tag)
                    <tr
                            class="@if($deal_tag->deal->status->pending)
                                    pending
                                @else
                            @if($deal_tag->deal->status->won)
                                    won
                                @else
                                    lost
                                @endif
                            @endif"
                    >
                        <td>
                            @if($deal_tag->deal->status->pending)
                                Pending
                            @else
                                @if($deal_tag->deal->status->won)
                                    Won
                                @else
                                    Lost
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($deal_tag->deal->opportunity->implementation_date)->format('d M Y') }}
                        </td>
                        <td>
                            @if(Auth::user()->isAssigned($deal_tag->deal->opportunity_id))
                                <a href="/vendor/deals/{{$deal_tag->deal->id}}">
                                    {{ $deal_tag->deal->opportunity->name }}
                                </a>
                            @else
                                {{ $deal_tag->deal->opportunity->name }}
                            @endif

                            @if($deal_tag->deal->reference)
                                <small>({{$deal_tag->deal->reference}})</small>
                            @endif
                        </td>
                        <td>{{ $deal_tag->deal->opportunity->endUser->organisation_type }}</td>
                        <td>
                            <ul>
                                @foreach($deal_tag->deal->opportunity->assignees as $assignee)
                                    <li>
                                        <img src="{{ $assignee->user->getAvatar() }}" />
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
                            @if(Auth::user()->isAssigned($deal_tag->deal->opportunity_id))
                                <a href="/vendor/deals/{{$deal_tag->deal->id}}">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                            @endif
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
        $('#vendor-admin-tag-deals-table').DataTable();

        function confirmTagDelete()
        {
            vex.dialog.confirm({
                message: 'Are you sure you want to delete this tag? This action cannot be undone.',
                callback: function (value) {
                    if(value === true){
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '{{route('vendor.admin.tag.delete', $tag->id)}}',
                            type: 'POST',
                            success: function(result) {
                                window.location.href = '{{route('vendor.admin.tags')}}'
                            }
                        }).fail(function(err) {
                            vex.dialog.alert({
                                message: 'ERROR: ' + err.responseText,
                            });
                        });
                    }
                }
            })
        }

        $(document).ready(function(){
            $("#tag_background_color").spectrum({
                color: "{{$tag->color}}",
                preferredFormat: "hex",
                showInput: true,
                allowEmpty:false,
                move: function(color) {
                    $("#tag_background_color").val(color.toHexString());
                }
            });
            $("#tag_text_color").spectrum({
                color: "{{$tag->text_color}}",
                preferredFormat: "hex",
                showInput: true,
                allowEmpty:false,
                move: function(color) {
                    $("#tag_text_color").val(color.toHexString());
                }
            });
        });

    </script>
@endsection