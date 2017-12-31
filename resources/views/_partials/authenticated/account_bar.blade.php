<div id="account-bar">
    <div id="menu-logo" class="pull-left">
        <a href="{{route('dashboard')}}">
            <span class="fire">FIRE</span><span class="cat">CAT</span>
        </a>
    </div>
    <div id="menu-links" class="pull-right">
        <ul>
            @if(Auth::user())
                @if(Auth::user()->isAdmin())
                    <a class="{{ Helper::isActiveRoute('admin.account') }}" href="{{route('admin.account')}}">
                        <li>
                            <div class="avatar">
                                <img src="{{Auth::user()->getAvatar()}}" />
                            </div>
                            <span class="account">Account</span>
                        </li>
                    </a>
                @elseif(Auth::user()->isVendor())
                    <a class="{{ Helper::isActiveRoute('vendor.account') }}" href="{{route('vendor.account')}}">
                        <li>
                            <div class="avatar">
                                <img src="{{Auth::user()->getAvatar()}}" />
                            </div>
                            <span class="account">Account</span>
                        </li>
                    </a>
                @elseif(Auth::user()->isPartner())
                    <a class="{{ Helper::isActiveRoute('partner.account') }}" href="{{route('partner.account')}}">
                        <li>
                            <div class="avatar">
                                <img src="{{Auth::user()->getAvatar()}}" />
                            </div>
                            <span class="account">Account</span>
                        </li>
                    </a>
                @endif

                <a href="{{route('logout')}}"><li>Logout</li></a>
            @endif
        </ul>
    </div>
</div>