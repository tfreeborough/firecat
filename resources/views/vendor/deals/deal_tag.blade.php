@extends('app')

@section('title', 'Tags for '.$deal->opportunity->name)

@extends('_partials.authenticated.account_bar')
@extends('_partials.vendor_menu')

@section('content')
    <div id="deal_tag">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Tags - {{ $deal->opportunity->name }}</h1>
            <h5 id="page-subtitle">Tags associated with {{ $deal->opportunity->name }}</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('vendor.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('vendor.deals')}}">
                            Deals
                        </a>
                    </li>
                    <li>
                        <a href="{{route('vendor.deal', $deal->id )}}">
                            {{ $deal->opportunity->name }}
                        </a>
                    </li>
                    <li>
                        Tags
                    </li>
                </ul>
            </div>
        </div>
        @include('_partials.flash_message')
        <div id="deal_tag_wrapper">
            <div id="existing_deal_tags">
                <h3>Existing Tags</h3>
                <div id="deal_tag_display">
                    @foreach($deal->tags as $tag)
                        <div class="deal_tag" style="color: {{$tag->organisation_tag->text_color}}; background: {{$tag->organisation_tag->color}}">
                            {{ $tag->organisation_tag->name }} <i class="fa fa-chain-broken" aria-hidden="true" onclick="unlinkTag('{{ $tag->id }}')"></i>
                        </div>
                    @endforeach
                    @if(count($deal->tags) === 0)
                        <i><p>No Tags have been added to this deal yet.</p></i>
                    @endif
                </div>
            </div>
            <div id="new_deal_tag">
                <h3>Add a new tag</h3>
                <div id="existing_deal_tag">
                    {!! Form::open(['url' => route('vendor.deal.tag.link',$deal->id)]) !!}
                    <div id="existing_deal_tag_wrapper">
                        <input id="existing_tag" type="hidden" name="tag" value="" />
                        <ul>
                            @foreach($user->organisation->tags as $tag)
                                <li data-tag_id="{{ $tag->id }}" onclick="selectExistingTag(event, '{{$tag->id}}')" value="{{$tag->id}}" style="color: {{$tag->text_color}}; background: {{$tag->color}}">
                                    {{ $tag->name }}
                                </li>
                            @endforeach
                                @if(count($user->organisation->tags) === 0)
                                    <i><p>You have no organisational tags that are available at the moment.</p></i>
                                @endif
                        </ul>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    {{ Form::submit('Link Tag', array_merge(['class' => 'form-control button'])) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <p class="link" onclick="toggleCreate()">Create a brand new tag</p>
                </div>
                <div id="create_deal_tag">
                    <div id="sample_tag">
                        <div class="deal_tag" style="background:#218884; color:#ffffff">
                            Sample
                        </div>
                        <p>
                            <small>This is what your tag will look like</small>
                        </p>
                    </div>
                    {!! Form::open(['url' => route('vendor.deal.tag.post',$deal->id)]) !!}
                    <div id="new_deal_tag_wrapper">
                        <div class="form-group">
                            {{ Form::label('tag_name', null, ['class' => 'control-label']) }}
                            {{ Form::text('tag_name', null, array_merge(['class' => 'form-control', 'placeholder' => 'Sample', 'onkeyup' => 'updateTagText(event)'])) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('tag_background_color', null, ['class' => 'control-label']) }}
                            {{ Form::text('tag_background_color', '#218884', array_merge(['class' => 'form-control', 'id' => 'tag_background_color'])) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('text_color', null, ['class' => 'control-label']) }}
                            {{ Form::text('text_color', '#ffffff', array_merge(['class' => 'form-control', 'id' => 'text_color'])) }}
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Create tag', array_merge(['class' => 'form-control button'])) }}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function unlinkTag(id)
        {
            vex.dialog.confirm({
                message: 'Are you sure you want to unlink this tag?',
                callback: function (value) {
                    console.log(value)
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{route('vendor.deal.tag.unlink', $deal->id)}}',
                        type: 'POST',
                        data: {
                            tag: id
                        },
                        success: function(result) {
                            window.location.reload();
                        }
                    });
                }
            })
        }

        function selectExistingTag(event, id)
        {
            var tag_id = event.target.dataset.tag_id;
            console.log(tag_id);
            $('#existing_tag').val(id);
            $('#existing_deal_tag_wrapper li').each(function(i, e){
                if($(e).attr('value') === tag_id){
                    console.log('id match');
                    $('#existing_deal_tag_wrapper li').removeClass('active');
                    $(e).addClass('active');
                }
            });
        }

        function toggleCreate()
        {
            $('#create_deal_tag').slideToggle(300);
        }

        function updateTagText(e)
        {
            $("#sample_tag .deal_tag").text(e.target.value);
        }

        $("#tag_background_color").spectrum({
            color: "#218884",
            preferredFormat: "hex",
            showInput: true,
            allowEmpty:false,
            move: function(color) {
                $("#tag_background_color").val(color.toHexString());
                $("#sample_tag .deal_tag").css('background',color.toHexString());
            }
        });
        $("#text_color").spectrum({
            color: "#ffffff",
            preferredFormat: "hex",
            showInput: true,
            allowEmpty:false,
            move: function(color) {
                $("#text_color").val(color.toHexString());
                $("#sample_tag .deal_tag").css('color',color.toHexString());
            }
        });
    </script>
@endsection