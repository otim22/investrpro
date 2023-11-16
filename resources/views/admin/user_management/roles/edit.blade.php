@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="d-flex justify-content-between">
                    <h4 class="fw-bold"><span class="text-muted text-capitalize fw-light">User management / <a
                                href="{{ route('admin.roles.index') }}">Roles</a> / {{ $role->name }} / </span>Edit
                    </h4>
                    <div>
                        <a class="btn btn-sm btn-outline-primary text-capitalize" type="button"
                            href="{{ route('admin.roles.index') }}" aria-haspopup="true" aria-expanded="false">
                            <i class='me-2 bx bx-arrow-back'></i>
                            Back to Roles
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-3">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 text-capitalize">Roles form</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.roles.update', $role) }}">
                            @csrf
                            @method('patch')

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="name">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" id="name"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $role->name) }}" required />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="permissions">Assign Permissions</label>
                                <div class="col-sm-10">
                                    <table class="table table-striped">
                                        <thead>
                                            <th class="d-flex">
                                                <input type="checkbox" name="all_permissions">
                                                <label for="all" class="ms-2">All</label>
                                            </th>
                                            <th>Name</th>
                                            <th>Web guard</th>
                                        </thead>

                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="permission[{{ $permission->name }}]"
                                                        value="{{ $permission->name }}" class='permission'
                                                        {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                                </td>
                                                <td>{{ $permission->name }}</td>
                                                <td>{{ $permission->guard_name }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10 mt-2">
                                    <button type="submit" class="btn btn-primary text-capitalize">Update role</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permissions"]').on('click', function() {
                if ($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked', false);
                    });
                }
            });
        });
    </script>
@endpush
