<!-- resources/views/users/partials/create-modal.blade.php -->
<div class="d-flex justify-content-end mb-3">
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createUserModal">
        <i class="bi bi-plus me-1"></i>{{ __('messages.create_user') }}
    </button>
</div>

<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="createUserModalLabel">{{ __('messages.create_user') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.first_name') }}</label>
                        <input type="text" name="firstname" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.last_name') }}</label>
                        <input type="text" name="lastname" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.email') }}</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.password') }}</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.confirm_password') }}</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.phone') }}</label>
                        <input type="text" name="phone_number" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.company') }}</label>
                        <input type="text" name="company" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label d-block">{{ __('messages.status') }}</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="active" checked>
                            <label class="form-check-label">{{ __('messages.active') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="inactive">
                            <label class="form-check-label">{{ __('messages.inactive') }}</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.role') }}</label>
                        <select name="role" class="form-select" required>
                            <option value="" disabled selected>{{ __('messages.select_role') }}</option>
                            @foreach ($allRoles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">{{ __('messages.create') }}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
