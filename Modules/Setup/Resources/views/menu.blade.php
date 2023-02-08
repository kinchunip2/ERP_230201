@php
    $city = ['setup.city.index', 'setup.city.edit', 'setup.city.show', 'setup.city.create'];
    $state = ['setup.state.index', 'setup.state.edit', 'setup.state.show', 'setup.state.create'];
    $country = ['setup.country.index', 'setup.country.edit', 'setup.country.show', 'setup.country.create'];

@endphp

@if(isset($include_from) and $include_from == 'setting')
    @if(permissionCheck('tax.index'))
        <li>
            <a href="{{ route('tax.index') }}"
               class="{{ spn_active_link('tax.index', 'active') }}">{{__('setup.Tax')}}</a>
        </li>
    @endif
    @if(permissionCheck('setup.city.index'))
        <li>
            <a href="{{ route('setup.city.index') }}" class="{{ spn_active_link($city, 'active') }}">{{ __('setting.City') }}</a>
        </li>
    @endif

    @if(permissionCheck('setup.state.index'))
        <li>
            <a href="{{ route('setup.state.index') }}" class="{{ spn_active_link($state, 'active') }}">{{ __('setting.State') }}</a>
        </li>
    @endif

    @if(permissionCheck('setup.country.index'))
        <li>
            <a href="{{ route('setup.country.index') }}" class="{{ spn_active_link($country, 'active') }}">{{ __('setting.Country') }}</a>
        </li>
    @endif


    @if (permissionCheck('languages.index'))
        <li>
            <a href="{{ route('languages.index') }}"
               class="{{ spn_active_link(['languages.index','language.translate_view'], 'active') }}">{{ __('common.Language') }}</a>
        </li>
    @endif

    @if(permissionCheck('currencies.index'))
        <li>
            <a href="{{ route('currencies.index') }}"
               class="{{ spn_active_link('currencies.index', 'active') }}">{{ __('common.Currency') }}</a>
        </li>
    @endif


    @if(permissionCheck('introPrefix.index'))
        <li>
            <a href="{{ route('introPrefix.index') }}"
               class="{{ spn_active_link('introPrefix.index', 'active') }}">{{__('setup.Intro Prefix')}}</a>
        </li>
    @endif
@else


    @if(permissionCheck('setup'))
        @php

            $setup = false;

            if(request()->is('setup/*'))
            {
                $setup = true;
            }

        @endphp

        <li class="{{ $setup ?'mm-active' : '' }}">
            <a href="javascript:" class="has-arrow" aria-expanded="false">
                <div class="nav_icon_small">
                    <span class="fas fa-wrench"></span>
                </div>
                <div class="nav_title">
                    <span>Setup</span>
                </div>
            </a>
            <ul>
                @if(permissionCheck('tax.index'))
                    <li>
                        <a href="{{ route('tax.index') }}">{{__('setup.Tax')}}</a>
                    </li>
                @endif

                @if(permissionCheck('country.index'))
                    <li>
                        <a href="{{ route('country.index') }}">{{__('setup.Country')}}</a>
                    </li>
                @endif

                @if (permissionCheck('languages.index'))
                    <li>
                        <a href="{{ route('languages.index') }}" class="{{ spn_active_link(['languages.index', 'language.translate_view']) }}">{{ __('common.Language') }}</a>
                    </li>
                @endif

                @if(permissionCheck('currencies.index'))
                    <li>
                        <a href="{{ route('currencies.index') }}">{{ __('common.Currency') }}</a>
                    </li>
                @endif


                @if(permissionCheck('introPrefix.index'))
                    <li>
                        <a href="{{ route('introPrefix.index') }}">{{__('setup.Intro Prefix')}}</a>
                    </li>
                @endif

            </ul>
        </li>
    @endif
@endif
