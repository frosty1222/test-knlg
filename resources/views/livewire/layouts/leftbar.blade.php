
<div>
    @if($isShowLeftBar === false)
    <i class="bi bi-caret-left-square-fill" wire:click="showBar"></i>
    @endif
    @if($isShowLeftBar === true)
    <div class="left-side-bar">
        <div class="left-content">
            <i class="bi bi-x-circle" wire:click="hideBar"></i>
            <div class="logo">
                <img src="{{asset('/images/bell.png')}}" alt="">
                <span>Admin Theme</span>
            </div>
            <div class="list-items">
                <ul>
                    @foreach($routes as $index => $route)
                        <li wire:click="showChildrenRoute({{ $index }})" class="{{$route['name']}}">
                            @if(empty($route['children']))
                            <a href="{{ $route['path'] }}">
                                <i class="{{$route['icon']}}"></i>
                                <span>{{ $route['name'] }}</span>
                            </a>
                            @endif
                            @if(!empty($route['children']))
                                <a>
                                    <i class="{{$route['icon']}}"></i><span>{{ $route['name'] }}</span>
                                </a>
                                @if($route['children'] && sizeof($route['children']) > 0 && $selectedIndex === $index)
                                <ul>
                                    @foreach($route['children'] as $childRoute)
                                        <li class="children">
                                            <a href="{{ $childRoute['path'] }}">
                                            <i class="{{$childRoute['icon']}}"></i>{{ $childRoute['name'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                @endif
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
</div>
