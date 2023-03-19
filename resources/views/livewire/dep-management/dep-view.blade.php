<div>
    <div class="main-content" wire:ignore>
        <div class="alert alert-secondary mx-4" role="alert">
            <span class="text-white"><strong>Manage Departments</strong>
        </div>
        @if (\Session::has('success'))
            <div class="alert alert-success mx-4">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4 p-2">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Departments</h5>
                            </div>
                            @can('department-add')
                                <a href="{{ route('add-departments') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Department</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2" style="overflow-x: auto;">
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
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $key => $d)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $d->id }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $d->name }}</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $d->created_at }}</span>
                                        </td>
                                        <td class="text-center">
                                            @can('department-edit')
                                                <a href="{{ route('edit-departments',$d->id) }}" class="cursor-pointer mx-3" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit Department">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
                                            @endcan
                                            @can('department-delete')
                                                <span>
                                                    <i onclick="confirmDelete({{$d->id}})" class="cursor-pointer fas fa-trash text-secondary"></i>
                                                </span>
                                            @endcan
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