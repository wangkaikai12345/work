<dropdown-trigger class="h-9 flex items-center" slot-scope="{toggle}" :handle-click="toggle">
    <img src="https://secure.gravatar.com/avatar/{{ auth()->user() ? md5(auth()->user()->email):'' }}?size=512" class="rounded-full w-8 h-8 mr-3"/>

    <span class="text-90">
        {{ auth()->user() ? auth()->user()->name : '您还未登陆' }}
    </span>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
    <ul class="list-reset">
        <li>
            <a href="{{ route('nova.logout') }}" class="block no-underline text-90 hover:bg-30 p-3">
                {{ __('Logout') }}
            </a>
        </li>
    </ul>
</dropdown-menu>
