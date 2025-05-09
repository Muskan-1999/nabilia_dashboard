<!-- resources/views/layouts/sidebar.blade.php -->

<div class="bg-white border-end vh-100" id="sidebar-wrapper" style="width: 250px;">
    <div class="list-group list-group-flush">
        <!-- Dashboard -->
        <a href="/dashboard"
           class="list-group-item list-group-item-action d-flex align-items-center {{ request()->is('dashboard') ? 'bg-danger text-white fw-bold' : '' }}">
            <i class="bi bi-house me-2"></i> {{ __('messages.dashboard') }}
        </a>

        <!-- User Management -->
        <a href="/users"
           class="list-group-item list-group-item-action d-flex align-items-center {{ request()->is('users') ? 'bg-danger text-white fw-bold' : '' }}">
            <i class="bi bi-person-circle me-2"></i>{{ __('messages.usermanagement') }}
        </a>
    </div>
</div>
