@extends('app')

@section('title', 'Create an opportunity')


@extends('_partials.authenticated.account_bar')
@extends('_partials.partner_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Create an opportunity</h1>
            <h5 id="page-subtitle">Create and submit a new opportunity.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('partner.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('partner.opportunities')}}">
                            Opportunities
                        </a>
                    </li>
                    <li>
                        Create an opportunity
                    </li>
                </ul>
            </div>
        </div>
        <div id="create-opportunity">
            {!! Form::open(['url' => '/partner/opportunities/create']) !!}
            <div id="vendor" class="row">
                <div class="col-xs-12">
                    <h3 class="title">Vendor</h3>
                </div>
                <div class="col-xs-12">
                    @if (count($errors) > 0)
                        <div class="row">
                            <div class="col-xs-12">
                                <div id="create-end-user-errors" class="text-left">
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
                </div>
                @if($magic_link)
                    {{ Form::hidden('vendor', $vendor->id, null) }}
                    <div class="col-xs-12">
                        <div class="alert alert-info">
                            <p>
                                You are creating this opportunity with <strong>{{ $vendor->name  }}</strong> using a magic link,
                                if you want to use a different vendor, please <a href="{{ route('partner.opportunities.create') }}"><strong>click here.</strong></a>
                            </p>
                        </div>
                    </div>
                @else
                    <div class="col-xs-12 col-sm-4">
                        {{ Form::label('vendor_search', 'Vendor Search', ['class' => 'control-label']) }}
                        <input type="text" class="form-control" placeholder="Search for a vendor..." onkeyup="vendorSearch(event)" />
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group">
                            {{ Form::label('vendor', 'Vendor', ['class' => 'control-label required']) }}
                            {{ Form::select('vendor', $vendors, 0, array_merge(['class' => 'form-control', 'id' => 'vendor-select'])) }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="alert alert-info">
                            <p>
                                Please take care when selecting a vendor as this cannot be modified once the opportunity has been created.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
            <div id="end-user" class="row">
                <div class="col-xs-12">
                    <h3 class="title">End User</h3>
                </div>
                <div class="col-xs-12 col-sm-4">
                    {{ Form::select('end_user', $endUsers, 0, array_merge(['class' => 'form-control'])) }}
                    <br />
                    <p>
                        This field is populated by end users that you have added into Firecat, if there are no end users listed,
                        please create one below.
                    </p>
                    <a href="{{ route('partner.endUsers.create') }}">
                        <button type="button" class="button action small">Create an end user</button>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-8">
                    <div class="alert alert-info">
                        <p>
                            When submitting an opportunity, you are agreeing to share information on your selected end user with the vendor.
                            Please ensure that your end user only contains the necessary information for the vendor and only work related information.
                        </p>
                    </div>
                    <div class="alert alert-warning">
                        <p>
                            NOTE: If you update an end user, any existing deals & opportunities linked to that end-user will also be updated to reflect the
                            new changes.
                        </p>
                    </div>
                </div>
            </div>
            <div id="opportunity" class="row">
                <div class="col-xs-12">
                    <h3 class="title">The Opportunity</h3>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class="subtitle">Overview</h3>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="alert alert-warning">
                                <p>
                                    NOTE: To help aid the vendor in categorising this opportunity, Please make your opportunity name as
                                    relevant to its contents as possible.
                                </p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                {{ Form::label('opportunity_name', 'Opportunity Name', ['class' => 'control-label required']) }}
                                {{ Form::text('opportunity_name', null, array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class="subtitle">Details</h3>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                {{ Form::label('opportunity_reference', 'Project Reference', ['class' => 'control-label']) }}
                                {{ Form::text('opportunity_reference', null, array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                {{ Form::label('date_of_award', 'Date of Award', ['class' => 'control-label']) }}
                                {{ Form::text('date_of_award', null, array_merge(['class' => 'form-control', 'placeholder' => 'DD/MM/YYYY', 'data-toggle' => 'datepicker'])) }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                {{ Form::label('implementation_date', 'Implementation Date', ['class' => 'control-label required']) }}
                                {{ Form::text('implementation_date', null, array_merge(['class' => 'form-control', 'placeholder' => 'DD/MM/YYYY', 'data-toggle' => 'datepicker'])) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                {{ Form::label('estimated_value', 'Estimated Value of Opportunity', ['class' => 'control-label required']) }}
                                {{ Form::text('estimated_value', null, array_merge(['placeholder' => '£', 'class' => 'form-control'])) }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                {{ Form::label('estimated_units', 'Estimated Number of Units', ['class' => 'control-label']) }}
                                {{ Form::text('estimated_units', null, array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                {{ Form::label('purchase_type', 'Purchase Type', ['class' => 'control-label required']) }}
                                {{ Form::select('purchase_type', [
                                '' => '-- Select Purchase Type --',
                                'Roll Out' => 'Roll Out',
                                'Upfront Purchase' => 'Upfront Purchase'
                                ], '', array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                {{ Form::label('procurement_type', 'Type of Procurement', ['class' => 'control-label required']) }}
                                {{ Form::select('procurement_type', [
                                '' => '-- Select Procurement Type --',
                                'Direct Request' => 'Direct Request',
                                'Public Tender' => 'Public Tender',
                                'Framework Procurement' => 'Framework Procurement'
                                ], '', array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                {{ Form::label('direct_indirect_procurement', 'Direct/Indirect Procurement', ['class' => 'control-label required']) }}
                                {{ Form::select('direct_indirect_procurement', [
                                '' => '-- Please choose an option --',
                                'Direct' => 'Direct',
                                'Indirect' => 'Indirect'
                                ], '', array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                {{ Form::label('competitors', 'Any Competitors?', ['class' => 'control-label']) }}
                                {{ Form::text('competitors', null, array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class="subtitle">Justification</h3>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="alert alert-info">
                                <p>
                                    If you are unsure what to write in the justification, here are some things that might help.
                                </p>
                                <ul>
                                    <li>Why do you need special pricing on this opportunity? Does the end user require pricing per item below a specific amount?</li>
                                    <li>Are there any external factors that require a specific product to be chosen for the end user.</li>
                                    <li>Are there any logistical factors that affect why you have chosen this vendor.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                {{ Form::label('justification', 'Justification', ['class' => 'control-label required']) }}
                                {{ Form::textarea('justification', null, array_merge(['placeholder' => 'Please enter a short justification for this opportunity', 'id' => 'justification', 'class' => 'form-control'])) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class="subtitle">Products</h3>
                            <div class="alert alert-info">
                                <p>
                                    Try to include as much product information as you can, this will help vendors give you more accurate pricing
                                </p>
                            </div>
                            <button id="add-another-product" type="button" class="button action small" onclick="addOpportunityProduct()">Add another product</button>
                        </div>
                        <div class="row product" data-product="1">
                            <div class="col-xs-12">
                                <div class="product_number col-xs-1">
                                    #1
                                </div>
                                <div class="form-group product_name col-xs-3">
                                    {{ Form::text('products[1][name]', null, array_merge(['class' => 'form-control', 'placeholder' => 'Product Name                                         '])) }}
                                </div>
                                <div class="form-group product_description col-xs-6">
                                    {{ Form::text('products[1][description]', null, array_merge(['class' => 'form-control product_group', 'placeholder' => 'Quantity, size, model ETC'])) }}
                                </div>
                                <div class="product_remove col-xs-1">
                                    <i class="fa fa-times disabled" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{ Form::submit('Create opportunity', array_merge(['class' => 'button large'])) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('[data-toggle="datepicker"]').datepicker({
            format: 'dd/mm/yyyy',
            startDate: new Date()
        });

        function vendorSearch(e)
        {
            var options = {
                shouldSort: true,
                threshold: 0.6,
                location: 0,
                distance: 100,
                maxPatternLength: 32,
                minMatchCharLength: 1,
                keys: [
                    "name",
                ]
            };
            let vendors = '{!! json_encode($vendors) !!}';
            vendors = JSON.parse(vendors);
            var fuse = new Fuse(vendors, options); // "list" is the item array
            var results = fuse.search(e.target.value);

            $('#vendor-select').html('');

            results.forEach(function(e,i){
                $('#vendor-select').append($('<option>', {
                    value: e.id,
                    text: e.name
                }));
            });

            if(results.length === 0){
                $('#vendor-select').append($('<option>', {
                    value: '',
                    text: '-- PLEASE SELECT A VENDOR --'
                }));

                vendors.forEach(function(e, i){
                    $('#vendor-select').append($('<option>', {
                        value: e.id,
                        text: e.name
                    }));
                });
            }
        }

        function addOpportunityProduct(){
            var count = 1;
            var lastRow = $('.product:first-child');

            $('.product').each(function(index, ele){
                count = (index+1)+1;
                lastRow = ele;
            });

            let clone = $(lastRow).clone();

            clone.data('product',count);
            clone.find('.product_number').text('#'+count);
            clone.find('.product_name input').attr('name', 'products['+count+'][name]').val('');
            clone.find('.product_description input').attr('name', 'products['+count+'][description]').val('');
            clone.find('.product_remove i').removeClass('disabled').attr('onclick', 'removeProduct('+count+')');

            $(lastRow).after(clone);

        }

        function removeProduct(number){
            $('.product').each(function(index, ele){
                if($(ele).data('product') === number){
                   $(ele).remove();
                }
            });

            setTimeout(function(){
                $('.product').each(function(index, ele){
                    var clone = $(ele);
                    var count = index+1;

                    clone.data('product',count);
                    clone.find('.product_number').text('#'+count);
                    clone.find('.product_name input').attr('name', 'products['+count+'][name]');
                    clone.find('.product_description input').attr('name', 'products['+count+'][description]');

                    if(count !== 1){
                        clone.find('.product_remove i').removeClass('disabled').attr('onclick', 'removeProduct('+count+')');
                    }
                });
            },200);
        }
    </script>
@endsection