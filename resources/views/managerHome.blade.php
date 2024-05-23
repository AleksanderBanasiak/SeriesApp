@extends('layouts.app')

@section('content')
<div class="container" style="color: white;">



    <h1 class="my-4 userList">Lista użytkowników</h1>
        <table class="table table-striped adminTab">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Show user series</th>
                    <th scope="col">Can add a series</th>
                    
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr id="tr_{{$user->id}}">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>                
                    <td>
                        <a href="/manager/series/{{$user->id}}" class="delButton">Show</a>
                    </td>     
                    <td>
                        <a href="javascript:void(0)" onclick="enableUser({{ $user->id }})" class="delButton">
                        @if($user->enabled == 1)
                        Yes
                        @else
                        No
                        @endif
                    </a>
                </tr>
            @endforeach
            </tbody>
        </table>
  
        <script type="text/javascript">
            function enableUser(id){
                if(confirm("Are you sure to enable this user?")){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: 'manager/enable/'+id,
                        type: 'PATCH',
                        success: function(result){
                            if(result.success){
                                location.reload(); 
                            } 
                        }
                    });
                }
            }
        </script>

</div>
@endsection
