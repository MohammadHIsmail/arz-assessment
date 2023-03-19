<div>
    <div class="main-content" wire:ignore>
        <div class="alert alert-secondary mx-4" role="alert">
            <span class="text-white"><strong>Manage users</strong>
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
                                <h5 class="mb-0">All Users</h5>
                            </div>
                            @can('user-add')
                                <a href="{{ route('add-user') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New User</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2" style="overflow-x: auto;">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Role
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
                                @foreach ($user as $key => $u)
                                    <tr>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $u->id }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $u->email }}</p>
                                        </td>
                                        <td class="text-center">
                                        @if(!empty($u->getRoleNames()))
                                            @foreach($u->getRoleNames() as $val)
                                                <p class="text-xs font-weight-bold mb-0">{{ $val }}</p>
                                            @endforeach
                                        @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $u->created_at }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if($u->id != 1)
                                                @can('user-edit')
                                                    <a href="{{ route('edit-user',$u->id) }}" class="cursor-pointer mx-3" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Edit user">
                                                        <i class="fas fa-user-edit text-secondary"></i>
                                                    </a>
                                                @endcan
                                                @can('user-delete')
                                                    <span>
                                                        <i onclick="confirmDelete({{$u->id}})" class="cursor-pointer fas fa-trash text-secondary"></i>
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
    <div wire:ignore.self class="modal" id="viewuserModal" tabindex="-1" role="dialog" aria-labelledby="viewuserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewuserModalLabel">{{ $selectedUser->userId }}</h5>
                    <button type="button" class="btn btn-transparent shadow-none" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span class="d-flex align-items-center">
                        <b class="text-s mb-0">User ID:</b>
                        <p class="text-xs font-weight-bold mb-0" style="margin-left: 1rem;">{{ $selectedUser->userId ?? '' }}</p>
                    </span>
                    <span class="d-flex align-items-center">
                        <b class="text-s mb-0">Role: </b>
                        @if(!empty($selectedUser->getRoleNames()))
                            @foreach($selectedUser->getRoleNames() as $val)
                                <p class="text-xs font-weight-bold mb-0" style="margin-left: 1rem;">{{ $val }}</p>
                            @endforeach
                        @endif                            
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>