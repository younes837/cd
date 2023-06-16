<table class="table table-hover ">
    <thead>
      <tr>
        <th>{{ __('locale.Avatar') }}</th>
        {{-- <th>Username</th>
        <th>Email</th> --}}
        <th>{{ __('locale.Address') }}</th>
        {{-- <th>Phone-Number</th> --}}
        <th>{{ __('locale.Role') }}</th>
        <th>{{ __('locale.City') }}</th>
        <th>{{ __('locale.Action') }}</th>
   
      </tr>
    </thead>
    <tbody >
        @if (count($users)==0)

            <div class="alert alert-secondary mt-1 alert-validation-msg" role="alert">
                <div class="alert-body d-flex align-items-center">
                <i data-feather="info" class="me-50"></i>
                <span>No matching  <strong>User</strong> was found .</span>
                </div>
            </div>
        @else
    
        @foreach ($users as $user)
                    <tr>
                        <td>
                            {{-- <span class="avatar">
                                <img class="round"
                                  src="{{asset('images/'.$user->avatar )}}"
                                  alt="avatar" height="40" width="40">
                            </span> --}}

                            <div class="d-flex flex-row align-items-center mb-50">
                              <div class="avatar me-50">
                                <a href="{{route('Users.show',$user->id)}}">
                                <img
                                  src="{{asset('images/'.$user->avatar)}}"
                                  alt="Avatar"
                                  width="38"
                                  height="38"
                                /></a>
                              </div>
                              <div class="user-info">
                                <a href="{{route('Users.show',$user->id)}}">
                                <h6 class="mb-0 text-primary">{{$user->name}}</h6></a>
                                <small class="mb-0 text-muted">{{$user->email}}</small>
                              </div>
                            </div>
                        </td>
                        {{-- <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td> --}}
                        <td>
                            {{$user->adress}}
                        </td>
                        {{-- <td>
                            {{$user->phone}}
                        </td> --}}
                        @if ($user->role_id == 1)
                            <td >
                                <span class="badge rounded-pill badge-light-success">Admin</span>
                            </td>
                        @else
                            <td>
                                <span class="badge rounded-pill badge-light-info">User</span>
                            </td>
                        @endif
                        <td>
                            {{App\Models\Ville::where('id',$user->ville_id)->select('name')->first()->name}}
                        </td>
                        <td>
                            <div class="dropdown">
                              <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                <i data-feather="more-vertical"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end">
                                {{-- <a class="dropdown-item" >
                                  <i data-feather="edit-2" class="me-50"></i>
                                  <span>Edit</span>
                                </a>                                 --}}
                                <a href="{{ route('Users.destroy', $user->id) }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                  <i data-feather="trash" class="me-50"></i>
                                  <span>Delete</span>
                                </a>
                              <form id="delete-form-{{ $user->id }}" action="{{ route('Users.destroy', $user->id) }}" method="POST" style="display: none;">
                                  @csrf
                                  @method('DELETE')
                              </form>
                              </div>
                            </div>
                        </td>
                      </tr>
                    
                @endforeach
                @endif
            </tbody>
</table>
<script >
//     $('#button_edit').on("click",function(){
//         // $("#form_edit").submit()
//         var ele = $(this);
//         $.ajax({
//         url:"Users/"+ele.attr("data-id"),
//         method:"PUT"
//         success:function(data)
//       {}
// })
        
//     })
</script>


<section id="ecommerce-pagination ">
    <div class="row">
      <div class="col-sm-12">
        <nav id="pagination" aria-label="Page navigation example">
          {{$users->withQueryString()->links('pagination::bootstrap-5')}}
        </nav>
      </div>
    </div>
  </section>