<div class="sidebar sidebar-style-2">

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a href="{{ route('user.profile') }}">
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
                    <h4 class="text-section">Transaction</h4>
                </li>
                <li class="nav-item {{ $title == 'Payment Request' ? 'active' : '' }}">
                    <a href="{{ route('payment.index') }}">
                        <i class="fas fa-money-bill"></i>
                        <p>Payment Request</p>
                    </a>
                </li>
                <li class="nav-item {{ $title == 'Debit Note' ? 'active' : '' }}">
                    <a href="{{ route('debit.index') }}">
                        <i class="far fa-credit-card"></i>
                        <p>Debit Note</p>
                    </a>
                </li>
                @if (auth()->user()->role == 'admin')
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Components</h4>
                    </li>
                    <li class="nav-item {{ $title == 'Division' || $title == 'Bank' ? 'active submenu' : '' }}">
                        <a data-toggle="collapse" href="#division_menu" class="collapsed" aria-expanded="false">
                            <i class="far fa-building"></i>
                            <p>Division</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ $title == 'Division' || $title == 'Bank' ? 'show' : '' }}"
                            id="division_menu">
                            <ul class="nav nav-collapse">
                                <li class="{{ $title == 'Division' ? 'active' : '' }}">
                                    <a href="{{ route('division.index') }}">
                                        <span class="sub-item">Name Division</span>
                                    </a>
                                </li>
                                <li class="{{ $title == 'Bank' ? 'active' : '' }}">
                                    <a href="{{ route('bank.index') }}">
                                        <span class="sub-item">Bank Division</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ $title == 'WHT' || $title == 'VAT' ? 'active submenu' : '' }}">
                        <a data-toggle="collapse" href="#tax_menu" class="collapsed" aria-expanded="false">
                            <i class="fas fa-percent"></i>
                            <p>TAX</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ $title == 'WHT' || $title == 'VAT' ? 'show' : '' }}" id="tax_menu">
                            <ul class="nav nav-collapse">
                                <li class="{{ $title == 'WHT' ? 'active' : '' }}">
                                    <a href="{{ route('wht.index') }}">
                                        <span class="sub-item">WHT</span>
                                    </a>
                                </li>
                                <li class="{{ $title == 'VAT' ? 'active' : '' }}">
                                    <a href="{{ route('vat.index') }}">
                                        <span class="sub-item">VAT</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ $title == 'Vendor' ? 'active' : '' }}">
                        <a href="{{ route('vendor.index') }}">
                            <i class="fas fa-store"></i>
                            <p>Vendor</p>
                        </a>
                    </li>
                    <li class="nav-item {{ $title == 'User' ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}">
                            <i class="fas fa-user-alt"></i>
                            <p>User Account</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
