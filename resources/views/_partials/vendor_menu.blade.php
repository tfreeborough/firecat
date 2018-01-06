<div id="authenticated-menu">
    <div id="menu-links">
        <ul>
            <a href="{{route('vendor.dashboard')}}"
               class="{{ Helper::isActiveRoute('vendor.dashboard') }}"
            >
                <li>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
                </li>
            </a>
            <a href="{{route('vendor.opportunities')}}"
               class="{{ Helper::areActiveRoutes(['vendor.opportunities','vendor.opportunity','vendor.opportunity.messages','vendor.opportunity.threads']) }}"
            >
                <li>
                    <i class="fa fa-file-text" aria-hidden="true"></i> Opportunities
                </li>
            </a>
            <a href="{{route('vendor.deals')}}"
               class="{{ Helper::areActiveRoutes(['vendor.deals','vendor.deal','vendor.deal.tag']) }}"
            >
                <li>
                    <i class="fa fa-briefcase" aria-hidden="true"></i> Deals
                </li>
            </a>
            <a href="{{route('vendor.tags')}}"
               class="{{ Helper::areActiveRoutes(['vendor.tags','vendor.tags.tag']) }}"
            >
                <li>
                    <i class="fa fa-tags" aria-hidden="true"></i> Tags
                </li>
            </a>
            @if(Auth::user()->isVendorAdministrator(Auth::user()->organisation->id))
                <a href="{{route('vendor.admin')}}"
                   class="{{ Helper::areActiveRoutes([
                    'vendor.admin',
                    'vendor.admin.onboarding'
                   ]) }}"
                >
                    <li>
                        <i class="fa fa-sitemap" aria-hidden="true"></i> Administration
                    </li>
                </a>
            @endif
        </ul>
    </div>
</div>
<div id="menu-toggle">
    <i class="fa fa-bars" aria-hidden="true"></i>
</div>
<script>
    window.onload = function(){
        $(window).click(function() {
            $('#authenticated-menu').removeClass('showing');
        });

        $('#authenticated-menu').click(function(event){
            event.stopPropagation();
        });

        $('#menu-toggle').click(function(event){
            event.stopPropagation();
        });

        $('#menu-toggle').click(function(){
            if($('#authenticated-menu').hasClass('showing')){
                $('#authenticated-menu').removeClass('showing');
            }else{
                $('#authenticated-menu').addClass('showing');
            }
        });
    };
</script>

