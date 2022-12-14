<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           All Category
        </b>
        </h2>
    </x-slot>

    <div class="py-12">
       <div class="container">
        <div class="row">
      

            <div class="col-md-8">
                <div class="card">
                <div class="card-header">Update Categories Name</div>

                <div class="card-body">
                <form action="{{url('category/update/'.$categories->id)}}" method="POST">
                    @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Category Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="category_name" value="{{ $categories->category_name}}" >

    @error('category_name')
        <span class="text-danger">{{$message}}</span>
    @enderror
    
  </div>
 
  <button type="submit" class="btn btn-secondary" style="background-color:grey;">Update Category</button>
</form>
                </div>
                </div>
            </div>
        </div>
       </div>
    </div>
</x-app-layout>
