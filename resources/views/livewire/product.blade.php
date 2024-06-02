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
     <button class="btn btn-success"><i class="bi bi-plus-square"></i></button>
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
                        <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
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
