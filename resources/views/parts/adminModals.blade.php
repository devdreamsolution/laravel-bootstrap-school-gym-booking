<!-- Create Modal -->
<div class="modal fade" id="modal-create-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create a Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-create-contact">
                    <div class="form-group">                        
                        <select class="browser-default custom-select" id="activity"  name="activity">
                            <option value="1"> swimming pool </option>
                            <option value="2"> indoor running tracks </option>
                            <option value="3"> tennis </option>
                            <option value="4"> football </option>
                            <option value="5"> boxing </option>
                        </select>                        
                    </div>
                    <div class="form-group">                        
                        <input id="place" type="text" class="form-control" name="place" placeholder="Place">
                    </div>
                    <div class="form-group">                        
                        <input id="add_date" type="text" class="form-control" name="date">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="btn-save-contact">Save Booking</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="modal-edit-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit a Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit-contact">
                    <input type="hidden" class="form-control" id="contact_id">
                    <div class="form-group">                        
                        <select class="browser-default custom-select" id="edit_activity"  name="activity">
                            <option value="1"> swimming pool </option>
                            <option value="2"> indoor running tracks </option>
                            <option value="3"> tennis </option>
                            <option value="4"> football </option>
                            <option value="5"> boxing </option>
                        </select>                        
                    </div>
                    <div class="form-group">                        
                        <input id="place" type="text" class="form-control" name="place" placeholder="Place">
                    </div>
                    <div class="form-group">                        
                        <input id="edit_date" type="text" class="form-control" name="date">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="btn-update-contact">Update Booking</button>
            </div>
        </div>
    </div>
</div>