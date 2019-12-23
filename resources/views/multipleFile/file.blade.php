@extends('master')
@section('content')
    <form method="post" action="{{ route('file.upload') }}" id="student_form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Multiple Images</label>
            <input type="file" name="file[]" class="form-control" id="file" accept="image/*" multiple placeholder="Image">
        </div>
        <div class="col-md-3">
            <input type="submit" name="upload" value="upload" class="btn btn-success">
        </div>
    </form>
    <br>
    <div class="progress">
        <div class="progress-bar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"
             style="width: 0%">
            0%
        </div>
    </div>
    <br>
    <div id="success" class="row">

    </div>


@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('form').ajaxForm({
                beforeSend:function(){
                    $('#success').empty('');
                    $('.progress-bar').text('0%');
                    $('.progress-bar').css('width','0%');
                },
                uploadProgress:function(event, position, total, percentComplete){
                   $('.progress-bar').text(percentComplete + '0%');
                   $('.progress-bar').css('with', percentComplete +'0%');
                },
                success:function(data){
                    $('#success').html('<div class="text-success text-center"><b>'
                        +data.success+'</b></div></br></br>');
                    $('#success').append(data.image);
                    $('.progress-bar').text('Uploaded');
                    $('.progress-bar').css('width','100%');
                }
            });
        });
    </script>
@endsection
