<?php require_once 'Configs/helpers.php'; ?>
<div class="bg-transparent">
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($row['title']); ?></td>
                                <td class="px-6 py-4"><?php echo e($row['description']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $row['status'] == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                        <?php echo e(ucfirst($row['status'])); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e(date('Y-m-d H:i', strtotime($row['created_at']))); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button type="button" class="text-blue-600 hover:text-blue-900 mr-3" onclick="document.getElementById('editModal<?php echo attr($row['id']); ?>').classList.remove('hidden')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="?delete=<?php echo attr($row['id']); ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php require 'edit-modal.php'; ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No tasks found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 