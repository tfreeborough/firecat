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
               class="{{ Helper::isActiveRoute('vendor.opportunities') }}"
            >
                <li>
                    <i class="fa fa-file-text" aria-hidden="true"></i> Opportunities
                </li>
            </a>
            <a href="{{route('vendor.deals')}}"
               class="{{ Helper::isActiveRoute('vendor.deals') }}"
            >
                <li>
                    <i class="fa fa-briefcase" aria-hidden="true"></i> Deals
                </li>
            </a>
            <a href="{{route('vendor.activity')}}"
               class="{{ Helper::isActiveRoute('vendor.activity') }}"
            >
                <li>
                    <i class="fa fa-heartbeat" aria-hidden="true"></i> Activity
                </li>
            </a>
        </ul>
    </div>
</div>

