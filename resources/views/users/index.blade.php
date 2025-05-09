<x-app-layout>
    <div class="container d-flex justify-content-center">
        <div class="w-100" style="max-width: 1200px; padding-left: 1rem; padding-right: 1rem;">
            <h1 class="mb-4 text-center">{{ __('messages.usermanagement') }}</h1>

            <div class="d-flex justify-content-end mb-3">
                {{-- Create button or other controls can be added here --}}
            </div>

            @include('users.create-modal')

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.first_name') }}</th>
                        <th>{{ __('messages.last_name') }}</th>
                        <th>{{ __('messages.full_name') }}</th>
                        <th>{{ __('messages.email') }}</th>
                        <th>{{ __('messages.company') }}</th>
                        <th>{{ __('messages.phone') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.role') }}</th>
                        <th>{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->fullname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->company }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>
                            <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'secondary' }}">
                                {{ __('messages.' . $user->status) }}
                            </span>
                        </td>
                        <td>
                            @if ($user->roles->isNotEmpty())
                            <span class="badge bg-info text-dark">{{ $user->roles->first()->name }}</span>
                            @else
                            <span class="badge bg-warning text-dark">{{ __('messages.no_role') }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2 justify-content-center">
                                <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#viewUserModal{{ $user->id }}" title="{{ __('messages.view') }}">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}" title="{{ __('messages.edit') }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}" title="{{ __('messages.delete') }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Edit Modal --}}
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form method="POST" action="{{ route('users.update', $user->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center w-100 text-success" id="editUserModalLabel{{ $user->id }}">
                                            <strong>{{ __('messages.edit_user') }}</strong>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.firstname') }}</label>
                                            <input type="text" name="firstname" class="form-control" value="{{ $user->firstname }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.lastname') }}</label>
                                            <input type="text" name="lastname" class="form-control" value="{{ $user->lastname }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.email') }}</label>
                                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.phone') }}</label>
                                            <input type="text" name="phone_number" class="form-control" value="{{ $user->phone_number }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">{{ __('messages.company') }}</label>
                                            <input type="text" name="company" class="form-control" value="{{ $user->company }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label d-block">{{ __('messages.status') }}</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" value="active" {{ $user->status === 'active' ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ __('messages.active') }}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" value="inactive" {{ $user->status === 'inactive' ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ __('messages.inactive') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">{{ __('messages.role') }}</label>
                                            <select name="role" class="form-select form-select-sm" required>
                                                <option value="" disabled {{ !$user->roles->first() ? 'selected' : '' }}>{{ __('messages.select_role') }}</option>
                                                @foreach ($allRoles as $role)
                                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">{{ __('messages.save_changes') }}</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Delete Modal --}}
                    <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteUserModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteUserModalLabel{{ $user->id }}">{{ __('messages.delete_user') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ __('messages.confirm_delete') }} <strong>{{ $user->firstname }}</strong>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">{{ __('messages.delete') }}</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- View Modal --}}
                    <div class="modal fade" id="viewUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="viewUserModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm">
                            <div class="modal-content border-0 shadow-sm">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="viewUserModalLabel{{ $user->id }}">
                                        <i class="bi bi-person-circle me-2"></i> {{ __('messages.user_details') }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start px-3 py-2">
                                    <p><strong>{{ __('messages.fullname') }}:</strong><br>{{ $user->fullname }}</p>
                                    <p><strong>{{ __('messages.email') }}:</strong><br>{{ $user->email }}</p>
                                    <p><strong>{{ __('messages.phone') }}:</strong><br>{{ $user->phone_number }}</p>
                                    <p><strong>{{ __('messages.company') }}:</strong><br>{{ $user->company }}</p>
                                    <p><strong>{{ __('messages.status') }}:</strong><br>
                                        <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'secondary' }}">
                                            {{ __('messages.' . $user->status) }}
                                        </span>
                                    </p>
                                    <p><strong>{{ __('messages.role') }}:</strong><br>
                                        @if ($user->roles->first())
                                        <span class="badge bg-info text-dark">{{ $user->roles->first()->name }}</span>
                                        @else
                                        <span class="text-muted">{{ __('messages.no_role') }}</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="modal-footer bg-light py-2">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
</x-app-layout>