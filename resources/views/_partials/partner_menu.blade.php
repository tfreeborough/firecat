<div id="authenticated-menu">
    <div id="menu-links">
        <ul>
            <a href="{{route('partner.dashboard')}}"
               class="{{ Helper::isActiveRoute('partner.dashboard') }}"
            >
                <li>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
                </li>
            </a>
            <a href="{{route('partner.opportunities')}}"
               class="{{ Helper::areActiveRoutes(['partner.opportunities','partner.opportunities.create','partner.opportunity','partner.opportunity.threads']) }}"
            >
                <li>
                    <i class="fa fa-file-text" aria-hidden="true"></i> Opportunities
                </li>
            </a>
            <a href="{{route('partner.deals')}}"
               class="{{ Helper::areActiveRoutes(['partner.deals','partner.deal']) }}"
            >
                <li>
                    <i class="fa fa-briefcase" aria-hidden="true"></i> Deals
                </li>
            </a>
            <a href="{{route('partner.endUsers')}}"
               class="{{ Helper::areActiveRoutes(['partner.endUsers','partner.endUsers.create']) }}">
                <li>
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i> End Users
                </li>
            </a>
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