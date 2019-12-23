@extends('master')
@section('content')
    <br>
    <br>
    <br>
    <h2>All Posts</h2>
    <br>
    <button id="addModalShow" class="btn btn-success">Add Post</button>
    <br>
    <!-- Button trigger modal -->
    <!-- Modal -->
    @include('post.modal')
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

    <script type="text/javascript">
        $('#addModalShow').on('click', function () {
            $('.modalFormShow').modal('show');
        })
    </script>
@endsection
