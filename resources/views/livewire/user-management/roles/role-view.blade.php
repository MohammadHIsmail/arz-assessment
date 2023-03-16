<div>
    <div class="main-content">
        <div class="alert alert-secondary mx-4" role="alert">
            <span class="text-white"><strong>Manage Roles</strong>
        </div>
        @if (\Session::has('success'))
            <div class="alert alert-success mx-4">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4 p-3">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">Roles</h5>
                            </div>
                            @can('role-add')
                                <a class="btn bg-gradient-primary btn-sm mb-0" href="{{ route('add-role') }}">+&nbsp; New Role</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role as $key => $r)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $r->id }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $r->name }}</p>
                                        </td>
                                        <td class="text-center">
                                        @if($r->id != 1)
                                            @can('role-edit')
                                                <a href="{{ route('edit-role',$r->id) }}" class="mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit role">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
                                            @endcan
                                            @can('role-delete')
                                            <span>
                                                <i onclick="confirmDelete({{$r->id}})" class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </span>
                                            @endcan
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>