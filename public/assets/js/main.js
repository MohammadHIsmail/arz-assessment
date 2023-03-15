function confirmDelete(id) {
    swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {   
            Livewire.emit('destroy',id);
        }
    });
}

function stopWarAlert() {
    swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {   
            Livewire.emit('stopWar',1);
        }else{
            Livewire.emit('stopWar',0);
        }
    });
}

$(document).ready(function() {
    $(function() {
        $('.datatable').DataTable(
            {
                responsive: true,
                colReorder: true,
                "initComplete": function(settings, json) {
                    $('.loading').hide();
                    $('.dt').show();
                  }
            }
        );
        $('.loading').show();
    });
});