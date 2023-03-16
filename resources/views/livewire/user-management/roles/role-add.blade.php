<div>
    <div class="container">
        <div class="justify-content-center">
            @if (count($errors) > 0)
                <div class="alert alert-danger mt-2">
                    <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    Create role
                    <span class="float-right mt-2">
                        <a class="btn btn-primary" href="{{ route('roles') }}">Roles</a>
                    </span>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="role-name" class="form-control-label">{{ __('Role Name') }}</label>
                                    <div class="@error('name')border border-danger rounded-3 @enderror">
                                        <input wire:model="name" class="form-control" type="text" placeholder="Name"
                                            id="role-name">
                                    </div>
                                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header d-flex align-items-center gap-4">
                                <h3><b>Permissions</b></h3>
                                <div class="form-check">
                                    <input wire:click="selectAllPermissions" class="form-check-input" type="checkbox" value="" id="selectall">
                                    <label class="form-check-label" for="selectall">
                                        Select All
                                    </label>
                                </div>
                            </div>
                            <div class="px-4">
                                @foreach($filtererdPermissions as $permissionkey => $value)
                                    <table class="table table-striped border border-2 border-dark w-100">
                                        <thead>
                                            <tr>
                                                <th colspan="5" class="text-center" scope="col">{{$permissionkey}}</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Permission</th>
                                                <th scope="col">Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($value as $key => $v)
                                                <tr>
                                                    <td class="ps-4 w-50">
                                                        <div class="form-check">
                                                            <input wire:model="selectedPermission.{{ $v['id'] }}" class="form-check-input" type="checkbox" value="" id="{{ $v['id'] }}">
                                                            <label class="form-check-label" for="selectedPermission.{{ $v['name'] }}">
                                                                {{$permissionkey}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="ps-4 w-50">
                                                        <label class="form-check-label" for="selectedPermission.{{ $v['name'] }}">
                                                            {{$v['permissionSubName']}}
                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>
                        </div>
                        @error('role.selectedPermission') <div class="text-danger">{{ $message }}</div> @enderror
                        <div class="d-flex justify-content-end">
                            <button type="submit" wire:click="store" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>