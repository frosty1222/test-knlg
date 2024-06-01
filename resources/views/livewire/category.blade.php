<div>
    @if(session('alert-type') === "warning")
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong>{{session('message')}}</strong> 
    </div>
    
    <script>
      $(".alert").alert();
    </script>
    @endif
    @if(session('alert-type') === "success")
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong>{{session('message')}}</strong> 
    </div>
    
    <script>
      $(".alert").alert();
    </script>
    @endif
    <h2 class="text-primary">{{$title}}</h2>
   <div class="helper-button">
    <button class="btn btn-success"><i class="bi bi-plus-square"></i></button>
    <button class="btn btn-danger"  onclick="confirmDeletion(event,'deleteCategory')"><i class="bi bi-trash"></i></button>
   </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Select</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $d)
                <tr>
                    <td>{{$index +1}}</td>
                    <td><input type="checkbox" wire:change='collectId({{$d->id}},event.target.checked)'></td>
                    <td>{{$d->name}}</td>
                    <td>
                        <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </table>
    <div class="pagination-section" style="display:flex;justify-content:right;">{{$data->links()}}</div>
</div>
<script>
   function confirmDeletion(event,action) {
    event.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            @this.call('deleteCategory');
        }
    })
    }
    if( session('alert-type')){
            Swal.fire({
            title: '{{ session('alert-type') === 'success' ? 'Success' : 'Warning' }}',
            text: '{{ session('message') }}',
            icon: '{{ session('alert-type') }}',
            showCancelButton: '{{ session('alert-type') === 'warning' }}',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Close'
            });
    }
</script>