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
                    <i class="fa fa-sitemap" aria-hidden="true"></i> Onboarding
                </li>
            </a>
            <a href="{{route('admin.partners')}}"
               class="{{ Helper::areActiveRoutes(['admin.partners','admin.partners.index','admin.partners.create']) }}"
            >
                <li>
                    <i class="fa fa-users" aria-hidden="true"></i> Partner Management
                </li>
            </a>
        </ul>
    </div>
</div>