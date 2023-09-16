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
                            List of Bin
                        </div>
                            <table class="table caption-top table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col" class="table-secondary">List</th>
                                    <th scope="col" class="table-secondary">Employee</th>
                                    <th scope="col" class="table-secondary">Department Name</th>
                                    <th scope="col" class="table-secondary">created_at</th>
                                    <th scope="col" class="table-secondary">Restore</th>
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
                                            <a href="{{url('/department/restore/'.$item->id)}}" class="btn btn-primary">Restore</a>
                                        </td>
                                        <td>
                                            <a href="{{url('/department/delete/'.$item->id)}}" class="btn btn-danger">Delete</a>

                                        </td>
                                        
                                    </tr>
            
                                    @endforeach
                                  
                                </tbody>
                            </table>
                            {{$department->links()}}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>