<div class="p-3" style="background: #fff">

    <x-datatable.card-header :icon="'products'" :title="'My ToDos'">

    </x-datatable.card-header>

    <div class="card-body p-0 mb-3">
        <x-datatable.datatable :headers="[
            ['name' => '#', 'width' => '5%'],
            'Name',
            ['name' => 'Description', 'width' => '45%'],
            ['name' => 'Due Date', 'nowrap' => 'nowrap'],
            'Status',
            'Created by',
            ['name' => 'Action', 'width' => '10%', 'classes' => 'no-sort']
        ]">

            @forelse ($projects as $key => $project)
                <tr class="align-middle">
                    <td>{{ ++$key }}</td>
                    <td nowrap>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td nowrap>{{ $project->due_date }}</td>
                    <td nowrap>{!! getStatus($project->status) !!}</td>
                    <td nowrap>{{ get_logged_staff_name($project->createdBy->id) }}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Tasks Detail - {{ $project->name }}" data-bs-url="form_edit/workOnTask/{{ $project->project_id }}" data-bs-size="modal-xl"> View Task</button>
                    </td>
                </tr>
            @empty
                <tr class="align-middle">
                    <td colspan="10">No Data</td>
                </tr>
            @endforelse
        </x-datatable.datatable>

    </div> <!-- /.card-body -->
</div> <!-- /.card -->
