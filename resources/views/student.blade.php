@extends('master')
@section('content')
    <br>
    <br>
    <br>
    <h2>Student List</h2>
    <br>
    <button id="modalForm" class="btn btn-success">Add Student</button>
    <br>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal modalShowEdit fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addStudent">Add Student</h4>
                    <h4 class="modal-title" style="display: none" id="editStudent">Edit Student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('students.store') }}" id="student_form">
                        @csrf
                        <span class="text-danger" id="form_output"></span>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input autofocus type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Address</label>
                            <input type="text" name="address" class="form-control" id="address" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="hidden" id="hidden_Id" name="id" value="">
                            <input type="submit" name="submit" id="action" value="Add" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <table id="user_table" class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Sl</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Title</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

@endsection
@section('script')

    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            //Get all and show in dataTables
            $('#user_table').DataTable({
                processing: true,
                serverSide: true,
                    ajax:{
                        url: "{{ route('students.index') }}",
                    },
                columns:[
                    { data:'id', name:'id' },
                    { data:'name', name:'name' },
                    { data:'address', name:'address' },
                    { data:'title', name:'title'},
                    { data:'action', name:'action', orderable:false }
                ]
            });
        });


        $('#modalForm').on('click', function () {   //modal show for new record create
            $('.modal-title').html('');
            $('.modal-title').html('Add Student');
            $('#showModal').modal('show');
            $('#student_form')[0].reset();
            $('#form_output').html('');
            $('#button_action').val('insert');
            $('#action').val('');
            $('#action').val('Add');
        });

        $(document).on('click', '.edit', function () {  //get data for editing
            var id = $(this).attr('id');
            $('#form_output').html('');
            $('#hidden_Id').val(id);
            var name = $(this).parent().parent().find('td').eq(1).text();
            var address = $(this).parent().parent().find('td').eq(2).text();
            var title = $(this).parent().parent().find('td').eq(3).text();
            $('.modalShowEdit').modal('show');
            $('.modal-title').html('');
            $('.modal-title').html('Edit Student');
            $('#action').val('');
            $('#action').val('Update');
            $('#name').val(name);
            $('#address').val(address);
            $('#title').val(title);
        });


        $('#student_form').on('submit', function (event) {
            event.preventDefault();
            if($('#action').val() == 'Add'){            // insert new record
                var form_data = $(this).serialize();
                $.ajax({
                    url: '{{ route("students.store") }}',
                    method: "POST",
                    data: form_data,
                    dataType: "json",
                    success: function (data) {
                        $('#student_form')[0].reset();
                        $('#user_table').DataTable().ajax.reload();
                        $('#showModal').modal('hide');
                        swal({
                            title: "Good Job!",
                            text: "You clicked the button!",
                            icon: "success",
                            button: "Great",
                        });
                    },
                    error: function (data) {
                        var allerror = JSON.parse(data.responseText);// to understand call json parse
                        var error_object = allerror.errors; // it is make array boject
                        for (var elemete in error_object) { // it convert frome object array
                            var itemError =  error_object[elemete][0];
                            $("#form_output").append(itemError+"<br>");
                        }
                    }
                })
            }
            if($('#action').val() == 'Update'){
                var id = $('#hidden_Id').val();
                var form_data = $(this).serialize();

                $.ajax({                        // update edit record
                    url: "{{ route('students.update', '') }}/" +id,
                    method: "PUT",
                    data:form_data,
                    success:function (data) {
                        $('#student_form')[0].reset();
                        $('#user_table').DataTable().ajax.reload();
                        $('#showModal').modal('hide');
                        swal({
                            title: "Good Job!",
                            text: "student Update Successfully!",
                            icon: "success",
                            button: "Great",
                        });
                    },
                    error:function (data) {
                        var allerror = JSON.parse(data.responseText);// to understand call json parse
                        var error_object = allerror.errors; // it is make array boject
                        for (var elemete in error_object) { // it convert from object array
                            var itemError =  error_object[elemete][0];
                            $("#form_output").append(itemError+"<br>");
                        }
                        swal({
                            title: "Ooop..",
                            text: "Student Update Fail!",
                            icon: "error",
                            button: "Try Again",
                        });
                    }
                });
            }
        });

        $(document).on('click','.delete', function () {
            var id = $(this).attr('id');
            if(confirm('Are you sure is student')){
                $.ajax({
                    url: "{{ route('students.destroy', '') }}/" +id,
                    method:"delete",
                    data:{id:id},
                    success:function (data) {
                        $('#user_table').DataTable().ajax.reload();
                        swal({
                            title: "Good Job!",
                            text: "student Deleted Successfully!",
                            icon: "success",
                            button: "Great",
                        });
                    },
                    error:function (data) {
                        swal({
                            title: "Ooop..",
                            text: "Student Deleted Fail!",
                            icon: "error",
                            button: "Try Again",
                        });
                    }
                });
            }else{
                return false;
            }
        })
    </script>

@endsection
