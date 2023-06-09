<div class="sidebar sidebar-style-2">

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ auth()->user()->name }}
                            <span class="user-level">{{ auth()->user()->email }}</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item {{ $title == 'Dashboard' ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item {{ $title == 'Payment Request' ? 'active' : '' }}">
                    <a href="{{ route('payment.index') }}">
                        <i class="fas fa-desktop"></i>
                        <p>Payment Request</p>
                    </a>
                </li>
                <li class="nav-item {{ $title == 'Debit Note' ? 'active' : '' }}">
                    <a href="{{ route('debit.index') }}">
                        <i class="fas fa-desktop"></i>
                        <p>Debit Note</p>
                    </a>
                </li>
                <li class="nav-item {{ $title == 'WHT' ? 'active' : '' }}">
                    <a href="{{ route('wht.index') }}">
                        <i class="fas fa-desktop"></i>
                        <p>WHT</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
