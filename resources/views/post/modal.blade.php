<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade modalFormShow" id="addModalShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form  id="multiSelectForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="image">Post Image</label>
                            <input  type="file" class="form-control" id="image" name="img">
                            <span id="store_image"></span>
                        </div>
                        <div class="form-group">
                            <label for="name">Post Name</label>
                            <input  type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Select</label>
                            <select class="form-control" name="tselect" id="select">
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Radio</label><br>
                                <input type="radio" id="radio1" value="1" name="tradio"> 1<br>
                                <input type="radio" id="radio2" value="2" name="tradio"> 2<br>
                                <input type="radio" id="radio3" value="3" name="tradio"> 3<br>
                        </div>
                        <div class="form-group">
                            <label for="name">Hobby</label><br>
                            <input type="checkbox" id="check1" value="basket" name="hobby[]"> Basket<br>
                            <input type="checkbox" id="check2" value="football" name="hobby[]"> football<br>
                            <input type="checkbox" id="check3" value="guitar" name="hobby[]"> guitar<br>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="">
                            <input type="hidden" name="hiddenId" id="heddenId" value="">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="cancleButton" value="create">Cancle</button>
                            <button type="submit" class="btn btn-primary"  id="action" value="create">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
