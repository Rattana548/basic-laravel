<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hello, {{Auth::user()->name}} 

            <b class="float-end">Number of ListUSer <span> {{ count($user) }}</span> </b>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <table class="table caption-top table-bordered">
                    <caption>List of users</caption>
                    <thead>
                      <tr>
                        <th scope="col" class="table-secondary">List</th>
                        <th scope="col" class="table-secondary">Name</th>
                        <th scope="col" class="table-secondary">Email</th>
                        <th scope="col" class="table-secondary">Start Create</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 0;    
                        ?>
                        @foreach ($user as $item)
                        <?php 
                            $i++;
                        ?>
                            
                        <tr>
                          <th scope="row">{{$i}}</th>
                          <td>{{ $item->name }}</td>
                          <td>{{ $item->email }}</td>
                          <td>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                        </tr>

                        @endforeach
                      
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</x-app-layout>
