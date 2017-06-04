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
               class="{{ Helper::areActiveRoutes(['partner.opportunities','partner.opportunities.create','partner.opportunity']) }}"
            >
                <li>
                    <i class="fa fa-file-text" aria-hidden="true"></i> Opportunities
                </li>
                <ul>
                    <a href="{{route('partner.endUsers')}}"
                       class="{{ Helper::areActiveRoutes(['partner.endUsers','partner.endUsers.create']) }}">
                        <li>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i> End Users
                        </li>
                    </a>
                </ul>
            </a>
            <a href="{{route('partner.deals')}}"
               class="{{ Helper::isActiveRoute('partner.deals') }}"
            >
                <li>
                    <i class="fa fa-briefcase" aria-hidden="true"></i> Deals
                </li>
            </a>
        </ul>
    </div>
</div>