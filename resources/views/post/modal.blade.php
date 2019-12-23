<div class="modal modalFormShow fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle">Add Post</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('posts.store') }}" id="student_form" enctype="multipart/form-data">
                    @csrf
                    <span class="text-danger" id="form_output"></span>
                    <div class="form-group">
                        <label>Title</label>
                        <input autofocus type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="number" name="phone" class="form-control" id="phone" placeholder="Phone">
                    </div>

                    <div class="form-group">
                        <label>Radio</label><br>
                        <input type="radio" name="radio" value="1"  id="adminName"> 1<br>
                        <input type="radio" name="radio" value="2"  id="adminName"> 2<br>
                        <input type="radio" name="radio" value="3"  id="adminName"> 3<br>
                    </div>

                    <div class="form-group">
                        <label>Checkbox</label><br>
                        <input type="checkbox" name="a" value="a" id="adminName"> A<br>
                        <input type="checkbox" name="b" value="b" id="adminName"> B<br>
                        <input type="checkbox" name="c" value="c" id="adminName"> C<br>
                    </div>

                    <div class="form-group">
                        <label>Select</label><br>
                        <select name="n">
                            <option value="a">Aziz</option>
                            <option value="b">Tareq</option>
                            <option value="c">Mizanur</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" id="image" placeholder="Image">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="submit" id="action" value="Add" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
