<div>
    <div class="main-content" wire:ignore>
        <div class="alert alert-secondary mx-4" role="alert">
            <span class="text-white"><strong>Audit Trail</strong>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4 p-2">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row align-items-start">
                            <div>
                                <h5 class="mb-0">Audit Trail</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <table id="dtable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Performed By
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Changed Table
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Changes
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Operation
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($auditTrail as $key => $a)
                                    <tr>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $a->id }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $a->performed_by }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $a->changed_table }}</p>
                                        </td>
                                        <td class="text-center w-50">
                                            <p class="text-secondary text-xs font-weight-bold text-wrap">{{ $a->changes }}</p>
                                        </td>
                                        <td class="text-center">
                                            @if($a->operation == "add")
                                                <span class="text-xs font-weight-bold" style="color:green;">{{ $a->operation }}</span>
                                            @elseif($a->operation == "edit")
                                                <span class="text-xs font-weight-bold" style="color:orange;">{{ $a->operation }}</span>
                                            @else
                                                <span class="text-xs font-weight-bold" style="color:red;">{{ $a->operation }}</span>
                                            
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