<?php require_once 'Configs/helpers.php'; ?>
<div class="modal fade" id="editModal<?php echo attr($row['id']); ?>" tabindex="-1" aria-labelledby="modal-title<?php echo attr($row['id']); ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modal-title<?php echo attr($row['id']); ?>">Edit Task</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <input type="hidden" name="id" value="<?php echo attr($row['id']); ?>">
          <div class="mb-3">
            <label for="editTitle<?php echo attr($row['id']); ?>" class="form-label">Title</label>
            <input type="text" class="form-control" id="editTitle<?php echo attr($row['id']); ?>" name="title" value="<?php echo attr($row['title']); ?>" required>
          </div>
          <div class="mb-3">
            <label for="editDescription<?php echo attr($row['id']); ?>" class="form-label">Description</label>
            <textarea class="form-control" id="editDescription<?php echo attr($row['id']); ?>" name="description" rows="3"><?php echo e($row['description']); ?></textarea>
          </div>
          <div class="mb-3">
            <label for="editStatus<?php echo attr($row['id']); ?>" class="form-label">Status</label>
            <select class="form-select" id="editStatus<?php echo attr($row['id']); ?>" name="status">
              <option value="pending" <?php echo $row['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
              <option value="completed" <?php echo $row['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="update" class="btn btn-success">Update Task</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div> 