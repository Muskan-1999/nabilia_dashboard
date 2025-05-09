@php
        $languages = ['en' => 'English', 'de' => 'German'];
        $flags = ['en' => 'gb.png', 'de' => 'de.png'];
        $currentLocale = Session::get('locale', 'en');
        @endphp

<nav class="navbar navbar-light bg-white border-bottom shadow-sm px-3">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        <!-- Left-Aligned Logo -->
        <div class="py-3">
            <img src="{{ asset('images/nobilia-logo.png') }}" alt="{{ __('logo_alt') }}" class="img-fluid" style="max-height: 40px;">
        </div>

        <!-- Centered Placeholder -->
        <div class="flex-grow-1"></div>

        <!-- Right-Aligned Language Switcher -->

       
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('images/' . $flags[$currentLocale]) }}" alt="{{ $languages[$currentLocale] }}" width="20" class="me-2">
            </button>
            <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('change.lang', ['lang' => 'en']) }}">
                        <img src="{{ asset('images/gb.png') }}" alt="English" width="20" class="me-2"> English
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('change.lang', ['lang' => 'de']) }}">
                        <img src="{{ asset('images/de.png') }}" alt="German" width="20" class="me-2"> German
                    </a>
                </li>
            </ul>
        </div>


        <!-- Right-Aligned Username + Avatar with Dropdown -->
        <div class="dropdown d-flex align-items-center gap-3">

            <!-- Username -->
            <span class="fw-semibold text-dark">
                {{ Auth::user()->firstname }}
            </span>

            <!-- Vertical Divider -->
            <div style="border-left: 1px solid #ccc; height: 24px;"></div>

            <!-- Avatar (Dropdown Toggle) -->
            <a href="#" class="d-flex align-items-center text-decoration-none" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('images/user-avatar.png') }}" alt="{{ __('user_avatar_alt') }}" class="rounded-circle" style="width: 36px; height: 36px;">
            </a>

            <!-- Dropdown Menu -->
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person me-2"></i> {{ __('messages.profile') }}
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="bi bi-box-arrow-right me-2"></i> {{ __('messages.logout') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</nav>