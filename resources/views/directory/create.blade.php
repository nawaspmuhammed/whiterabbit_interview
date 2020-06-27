<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('common/header')
    <body>
        <h4 class="heading">Add File</h4>
        <div class="flex-center position-ref full-height">
            

            <div class="content">
              

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route("save_file") }}"  enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                      <label for="exampleFormControlFile1">Upload File <span style="color:red">*</span>(txt,pdf,jpg,png,docx,jpeg,gif)</label>
                      <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>

                    <button class="btn btn-success">Submit</button>
                  </form>
            </div>
    </body>
</html>
