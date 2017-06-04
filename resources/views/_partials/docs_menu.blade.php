<div id="docs-menu">
    <div id="menu-links">
        <ul>
            <a href="{{route('dashboard')}}">
                <li>Dashboard</li>
            </a>

            <a href="{{route('docs')}}"
               class="{{ Helper::areActiveRoutes([
               'docs',
               ]) }}"
            >
                <li>Docs</li>
                <ul>
                    <a href="{{route('docs.opportunities')}}"
                       class="{{ Helper::areActiveRoutes(['docs.opportunities']) }}"
                    >
                        <li><i class="fa fa-angle-right" aria-hidden="true"></i> Opportunities</li>
                        <ul>
                            <a href="{{route('docs.opportunities.statuses')}}"
                               class="{{ Helper::areActiveRoutes(['docs.opportunities.statuses']) }}">
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i> Statuses</li>
                            </a>
                        </ul>
                    </a>
                </ul>
            </a>

        </ul>
    </div>
</div>