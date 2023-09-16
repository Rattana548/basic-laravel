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
                            List of users
                            @if (count($trashdepartment)>0)
                            <a href="{{route('bin')}}" class="btn btn-success float-end">bin</a>
                            @else
                            <a href="{{route('bin')}}" class="btn btn-success float-end disabled">bin</a>
                            @endif
                            
                        </div>
                            <table class="table caption-top table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col" class="table-secondary">List</th>
                                    <th scope="col" class="table-secondary">Employee</th>
                                    <th scope="col" class="table-secondary">Department Name</th>
                                    <th scope="col" class="table-secondary">created_at</th>
                                    <th scope="col" class="table-secondary">Edit</th>
                                    <th scope="col" class="table-secondary">Delete</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($department as $item)
                                        
                                    <tr>
                                      <th scope="row">{{$department->firstItem()+$loop->index}}</th>
                                      <td>{{ $item->user->name }}</td>
                                      <td>{{ $item->department_name }}</td>
                                      <td>
                                        @if ($item->created_at == Null)
                                        Unknow
                                        @else
                                        {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                        @endif
                                        <td>
                                        <a href="{{url('/department/edit/'.$item->id)}}" class="btn btn-primary mr-2 ml-2">Edit</a>
                                        </td>
                                        <td>
                                        <a href="{{url('/department/softdelete/'.$item->id)}}" class="btn btn-warning">Move to Bin</a>
                                    
                                        </td>
                                        
                                    </tr>
            
                                    @endforeach
                                  
                                </tbody>
                            </table>
                            {{$department->links()}}
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            form Department
                        </div>
                        <div class="card-body">
                            <form action="{{route('adddepartment')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="department_name">Name of Department</label>
                                    <input type="text" class="form-control" name="department_name">
                                </div>
                                @error('department_name')
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