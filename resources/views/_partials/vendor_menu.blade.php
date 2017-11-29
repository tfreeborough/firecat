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
            <a href="{{route('vendor.activity')}}"
               class="{{ Helper::isActiveRoute('vendor.activity') }}"
            >
                <li>
                    <i class="fa fa-heartbeat" aria-hidden="true"></i> Activity
                </li>
            </a>
            <a href="{{route('docs')}}"
               class="{{ Helper::isActiveRoute('docs') }}"
            >
                <li>
                    <i class="fa fa-book" aria-hidden="true"></i> Documentation
                </li>
            </a>
            @if(Auth::user()->isVendorAdministrator(Auth::user()->organisation->id))
                <a href="{{route('vendor.admin')}}"
                   class="{{ Helper::isActiveRoute('vendor.admin') }}"
                >
                    <li>
                        <i class="fa fa-sitemap" aria-hidden="true"></i> Administration
                    </li>
                </a>
            @endif
        </ul>
    </div>
</div>

