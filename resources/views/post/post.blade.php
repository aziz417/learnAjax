@extends('master')
@section('content')
    <br>
    <br>
    <br>
    <h2>All Posts</h2>
    <br>
    <button id="addModalShow" class="btn btn-success">Add Post</button>
    @include('post.modal')
    <br>
    <span id="success" style="display: none" class="btn-success"></span>
    <br>
    <table id="dataTable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Sl</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Post Number</th>
            <th scope="col">Hobby</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // modal show
        $('#addModalShow').on('click', function () {
            $('.modalFormShow').modal('show');
            $('#modalTitle').html('');
            $('#modalTitle').html('Add Post');
            $('#action').html('');
            $('#action').html('Add Post');
            $('#multiSelectForm')[0].reset();
        });

        //all data show
        $(document).ready(function(){
            //Get all and show in dataTables
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: "{{ route('posts.index') }}",
                },
                columns:[
                    { data:'id', name:'id' },
                    { data: 'image', name: 'image',
                        render: function( data, type, full, meta ) {
                            return '<img class="img-thumbnail" style="width: 80px; height: 80px;"'+
                            'src="{{asset('images/')}}/'+data+'"/>';
                        },
                        orderable: false
                    },
                    { data:'name',  name:'name' },
                    { data:'tselect', name:'tselect' },
                    { data:'tradio', name:'tradio'},
                    { data:'tcheck', name:'tcheck'},
                    { data:'action', name:'action', orderable:false }
                ]
            });
        });

        //data store here
        $("#action").click(function (e) {
            e.preventDefault();
            var totalFromData =  new FormData($('#multiSelectForm')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ route("posts.store") }}",
                type: "POST",
                data:totalFromData,
                contentType: false,
                processData: false,
                cache: false,
                success:function (data) {
                    $('.modalFormShow').modal('hide');
                    $('#success').show();
                    $('#success').html("Inserted Successfully");
                    console.log(data);
                },
                error:function (data) {
                    console.log(data);
                }
            })
        });

        // edit data
        $(document).on('click','.edit', function () {
            var id = $(this).attr('id');
            $.ajax({
                url:"posts/"+id+"/edit",
                method:"get",
                data: {
                    id: id,
                },
                datatype: "JSON",
                success: function(feedBackResult){
                    $("#multiSelectForm")[0].reset();
                    $('#modalTitle').html('Edit');
                    $('#action').html('');
                    $('#action').html('Update');
                    $('#heddenId').val(id);
                    $('.modalFormShow').modal('show');
                    $('#name').val(feedBackResult.data[0].name);
                    $('#select').val(feedBackResult.data[0].tselect);
                    $('#store_image').html('<img class="img-thumbnail" style="width: 120px; height: 120px;" src="{{asset('images/')}}/'
                        +feedBackResult.data[0].image+'">');
                    $('#store_image').append("<input type='hidden' name='hiddenImage' " +
                        "value='"+feedBackResult.data[0].image+"'>")
                }
            });
        });
    </script>
@endsection
