<div id="authenticated-menu">
    <div id="menu-links">
        <ul>
            <a href="{{route('admin.dashboard')}}"
            class="{{ Helper::isActiveRoute('admin.dashboard') }}"
            >
                <li>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
                </li>
            </a>
            <a href="{{route('admin.onboarding')}}"
            class="{{ Helper::areActiveRoutes(['admin.onboarding','admin.onboarding.index','admin.onboarding.create','admin.onboarding.add-user']) }}"
            >
                <li>
                    <i class="fa fa-sitemap" aria-hidden="true"></i> Vendors
                </li>
            </a>
            <a href="{{route('admin.partners')}}"
               class="{{ Helper::areActiveRoutes(['admin.partners','admin.partners.index','admin.partners.create']) }}"
            >
                <li>
                    <i class="fa fa-users" aria-hidden="true"></i> Partners
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