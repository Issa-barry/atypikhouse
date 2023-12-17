<?php
if (!Auth::check() or !Auth::user()->hasPermissionTo('dashboard_access'))
    return;
$activeMenu = \Modules\Core\Walkers\MenuWalker::getActiveMenu();
?>
<div class="bravo-admin-bar">
    <div class="container">
        <ul class="adminbar-menu">
            <li><a href="{{route('admin.index')}}"><i class=""></i> {{__("Dashboard")}}</a></li>
            @if(is_object($activeMenu))
                <li><a href="{{$activeMenu->getEditUrl()}}"><i class=""></i> {{__("Editer")}}</a></li>
            @endif
        </ul>
    </div>
</div>
