<div id="authenticated-menu">
    <div id="menu-links">
        <ul>
            <a href="{{route('dashboard')}}">
                <li><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</li>
            </a>

            <a href="{{route('docs')}}"
               class="{{ Helper::areActiveRoutes([
               'docs',
               ]) }}"
            >
                <li><i class="fa fa-book" aria-hidden="true"></i> Documentation</li>
                <ul>
                    <a href="{{route('docs.opportunities')}}"
                        class="{{ Helper::areActiveRoutes([
                            'docs.opportunities'
                        ]) }}"
                    >
                        <li>- Opportunities</li>
                        <ul>
                            <a href="{{route('docs.opportunities.statuses')}}"><li>-- Statuses</li></a>
                            <a href="{{route('docs.opportunities.considerations')}}"><li>-- Considerations</li></a>
                        </ul>
                    </a>
                </ul>
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