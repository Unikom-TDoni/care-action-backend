<tbody wire:sortable="updateOrder">
    @foreach($activities as $data)
    <tr wire:sortable.item="{{ $data->id }}" wire:key="task-{{ $data->id }}">
        <td wire:sortable.handle>{{ $data->activity_name }}</td>
        <td class="actions">
            <button class="btn btn-icon btn-sm btn-success" onclick="edit({{ $data->id }})"> <i class="fa fa-edit"></i> </button> 
            <button class="btn btn-icon btn-sm btn-danger" onclick="deleteData({{ $data->id }})"> <i class="fa fa-trash"></i> </button>
        </td>
    </tr>
    @endforeach
</tbody>
   