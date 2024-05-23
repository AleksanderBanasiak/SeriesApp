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
                    <th scope="col">Role</th>
                    <th scope="col">Delete user</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr id="tr_{{$user->id}}">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    @if($user->role == 1)
                    <td>Admin</td>
                    @elseif($user->role == 2)
                    <td>Manager</td>
                    @else
                    <td>User</td>
                    @endif
                    @if($user->role != 1)
                    <td>
                        <a href="javascript:void(0)" onclick="deleteUser({{ $user->id }})" class="btn btn-danger">Delete</a>
                    </td>
                    @else
                    <td>
                        You cannot delete admin!
                    </td>
                    @endif
                </tr>
            @endforeach


            </tbody>
        </table>
  
       
<script type="text/javascript">

        function deleteUser(id){
            if(confirm("Are you sure to delete this user?")){

                $.ajaxSetup({
                    
                    headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({

                    url:'delete_user/'+id,
                    type: 'DELETE',

                    success:function(result){
                        $("#"+result['tr']).slideUp("slow");
                    }
                });
            }
        }
</script>
</div>
@endsection
