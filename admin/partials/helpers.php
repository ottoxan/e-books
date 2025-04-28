<?php
function renderActionButtons($file, $id, $type)
{
    return '
        <button onclick="location.href=\'edit-'.$file.'.php?type=' . htmlspecialchars($type) . '&id=' . htmlspecialchars($id) . '\'" class="btn-primary m-1 p-1 rounded-2">
            <span class="text">Edit</span>
        </button>
        <button type="button" class="btn-danger p-1 rounded-2" data-toggle="modal" data-target="#deleteModal' . htmlspecialchars($id) . '">
            Delete
        </button>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal' . htmlspecialchars($id) . '" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel' . htmlspecialchars($id) . '" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel' . htmlspecialchars($id) . '">Are you sure?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" onclick="location.href=\'delete.php?type=' . htmlspecialchars($type) . '&id=' . htmlspecialchars($id) . '\'" class="btn btn-danger">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    ';
}
