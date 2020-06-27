<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @include('common/header')
    <body>
        <h4 class="heading">List Files</h4>
        <div class="flex-center position-ref full-height">
          
            <div class="content">
                 
            <div class="text-right">
                <form action="{{ route("index") }}" method="GET">
                <input name="search" type="text" class="form-control">
                <button class="btn btn-primary">Search</button>
                </form>
            </div>
            <div class="text-right pad"><a href="{{ route("create") }}" class="btn btn-success">Add</a>
            <a  class="btn btn-danger" href="{{ route('filehistory')}}">File history</a>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
          
            @endif
           
                <table class="table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">File Name</th>
                        <th scope="col">Action</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $key=> $item)
                        <tr>
                        <td scope="row">{{ $key+1 }}</td>
                        <td>{{$item->file_name}}</td>
                        <td><a href="{{$item->url}}" download="{{$item->file_name}}">
        <button type="button" class="btn btn-primary">Download</button>
                       
                        <form action="{{route('destroy',$item)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Delete</button>
                        </form>
                        </td>
                           
                          </tr>
                        @endforeach
                      
                  
                    </tbody>
                  </table>
                  <div class="text-right">{{ $files->links() }}</div>  
            </div>
        </div>
    </body>
</html>
