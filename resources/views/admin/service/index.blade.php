<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hello, {{Auth::user()->name}} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if (session("success"))
                    <div class="alert alert-success">
                        <b>{{session("success")}}</b>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            List of Service
                        </div>
                            <table class="table caption-top table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col" class="table-secondary">List</th>
                                    <th scope="col" class="table-secondary">Image</th>
                                    <th scope="col" class="table-secondary">Service Name</th>
                                    <th scope="col" class="table-secondary">created_at</th>
                                    <th scope="col" class="table-secondary">Edit</th>
                                    <th scope="col" class="table-secondary">Delete</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service as $item)
                                        
                                    <tr>
                                      <th scope="row">{{$service->firstItem()+$loop->index}}</th>
                                        <td>
                                            <img src="{{asset($item->service_image)}}" alt="" width="100" height="100">
                                        </td>
                                        <td>{{ $item->service_name }}</td>
                                        <td>
                                        @if ($item->created_at == Null)
                                        Unknow
                                        @else
                                        {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                        @endif
                                        <td>
                                        <a href="{{url('/service/edit/'.$item->id)}}" class="btn btn-primary mr-2 ml-2">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{url('/service/delete/'.$item->id)}}" class="btn btn-warning" onclick="return confirm('Are you sure to delete?')">Delete</a>
                                        </td>
                                        
                                    </tr>
            
                                    @endforeach
                                  
                                </tbody>
                            </table>
                            {{$service->links()}}
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            form Service
                        </div>
                        <div class="card-body">
                            <form action="{{route('addservice')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="service_name">Name of Service</label>
                                    <input type="text" class="form-control" name="service_name">
                                </div>
                                @error('service_name')
                                <div class="my-2">
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label for="service_image">Image of Service</label>
                                    <input type="file" class="form-control" name="service_image">
                                </div>

                                @error('service_image')
                                <div class="my-2">
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                                @enderror
                                <br>
                                <input type="submit" value="Save" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>