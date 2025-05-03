<?php require_once 'Configs/helpers.php'; ?>
<div id="editModal<?php echo attr($row['id']); ?>" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edit Task</h3>
                        <div class="mt-4">
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo attr($row['id']); ?>">
                                <div class="mb-4">
                                    <label for="editTitle" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="title" value="<?php echo attr($row['title']); ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="editDescription" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="description" rows="3"><?php echo e($row['description']); ?></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="editStatus" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="status">
                                        <option value="pending" <?php echo $row['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="completed" <?php echo $row['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                                    </select>
                                </div>
                                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                    <button type="submit" name="update" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Update Task</button>
                                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="document.getElementById('editModal<?php echo attr($row['id']); ?>').classList.add('hidden')">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 