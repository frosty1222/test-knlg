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
     <button class="btn btn-danger"  onclick="confirmDeletion(event,'deleteRecord')"><i class="bi bi-trash"></i></button>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="thead-inverse">
            <tr>
                <th>No.</th>
                <th>Select</th>
                <th>Name</th>
                <th>Discount price</th>
                <th>Actual price</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($products as $index =>$product)
                <tr>
                    <td scope="row">{{$index + 1}}</td>
                    <td>
                        <input type="checkbox" wire:change='collectId({{$product->id}})'>
                    </td>
                    <td style="max-width: 300px; text-overflow: ellipsis;">{{$product->name}}</td>
                    <td>{{$product->discount_price}}</td>
                    <td>{{$product->actual_price}}</td>
                    <td>{{$product->category ? $product->category->name:"" }}</td>
                    <td>
                        <button class="btn btn-warning" wire:click='editAction({{$product}})'><i class="bi bi-pencil-square"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </table>
     <div id="button-section">
        <div id="form-page">
            <div class="form-group">
                <input type="number" class="form-control" id="pageInput" wire:model="pageInput" min="1" max="{{ $products->lastPage() }}" value="{{ $products->currentPage() }}" placeholder="Enter a desire page" wire:change='upPage($event.target.value)'>
            </div>
        </div>
        <div class="pagination-section">{{$products->links()}}</div> 
     </div>
     <div class="modal-section" @if($isShowModal === true)>
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
                     <form  wire:submit.prevent="onSubmit">
                           <input type="number" wire:model='productId' hidden>
                          <div class="form-group">
                                <input type="text" id="myInput" class="form-control" wire:model="name" wire:change='checkName' placeholder="Enter product name" required="true">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                @if($alertMess !=="") <span class="text-danger">{{ $alertMess }}</span> @endif
                          </div>
                          <div class="form-group">
                                <input type="text" id="myInput" class="form-control" wire:model="discount_price" placeholder="Enter discount price" required="true">
                                @error('discount_price') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                          <div class="form-group">
                                <input type="text" id="myInput" class="form-control" wire:model="actual_price" placeholder="Enter actual price" required="true">
                                @error('actual_price') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                             <div class="form-group">
                               <label for="">Select a category</label>
                               <select class="form-control" wire:model='category_id'>
                                <option value=""></option>
                                @foreach ($categories as $data)
                                    <option value="{{$data->id}}" {{ $data->id == $category_id ? 'selected' : '' }}>{{$data->name}}</option>
                                @endforeach
                               </select>
                               @error('category_id') <span class="error">{{ $message }}</span> @enderror
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
     </div @endif>
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
            @this.call('deleteRecord');
        }
    })
    }
</script>
