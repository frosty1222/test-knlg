<div>
    @if(session('alert-type') === "warning")
    <div class="col-md-6" style="float: left">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{session('message')}}</strong> 
      </div>
    </div>
    
    <script>
      $(".alert").alert();
    </script>
    @endif
    @if(session('alert-type') === "success")
     <div class="col-md-6" style="float: right">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{session('message')}}</strong> 
      </div>
     </div>
    
    <script>
      $(".alert").alert();
    </script>
    @endif
    <h2 class="text-primary">{{$title}}</h2>
   <div class="helper-button">
    <button class="btn btn-success" wire:click='showModal(true)'><i class="bi bi-plus-square"></i></button>
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
                    <td><input type="checkbox" wire:change='collectId({{$d->id}},event.target.checked)' style="width: 30px"></td>
                    <td>{{$d->name}}</td>
                    <td>
                        <button class="btn btn-warning" wire:click='editAction({{$d}})'><i class="bi bi-pencil-square"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </table>
    <div id="button-section">
      <div id="form-page">
          <div class="form-group">
              <input type="number" class="form-control" id="pageInput" min="1" max="{{ $data->lastPage() }}" value="{{ $data->currentPage() }}" placeholder="Enter a desire page" wire:change='upPage($event.target.value)'>
          </div>
      </div>
      <div class="pagination-section">{{$data->links()}}</div> 
   </div>
   @if($isShowSubmitForm === true)
   <div class="modal-section">
    <div class="modal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$formTitle}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click='showModal(false)'>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="onSubmit()">
                        <input type="hidden" wire:model='id'>
                        <div class="form-group">
                            <input type="text" id="myInput" class="form-control" wire:model="name" wire:change='checkName' placeholder="Enter category name" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            @if($alertMess !== "") <span class="text-danger">{{ $alertMess }}</span> @endif
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click='showModal(false)'>Close</button>
                        </div>
                    </form>
                </div>
                <div wire:loading>
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...
              </div>
            </div>
        </div>
    </div>
   </div>
   @endif

</div>
<script>
  // $('#addModal').on('shown.bs.modal', function () {
  //  $('#myInput').trigger('focus')
  // })
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
</script>