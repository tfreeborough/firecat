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