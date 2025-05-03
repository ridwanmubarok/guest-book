<?php
require_once 'Configs/database.php';
require_once 'Configs/helpers.php';
require_once 'Controllers/TaskController.php';

$taskController = new TaskController($conn);

$hasOperation = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $taskController->createTask($_POST['title'], $_POST['description']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $taskController->updateTask($_POST['id'], $_POST['title'], $_POST['description'], $_POST['status']);
}

if (isset($_GET['delete'])) {
    $taskController->deleteTask($_GET['delete']);
}

$result = $taskController->getAllTasks();
$msg = $taskController->getMessage();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'Layouts/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System | PWEB 2025 | UNIVERSITAS SIBER ASIA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 h-screen overflow-y-hidden">
    <div class="h-full flex flex-col">

       <main class="py-10 h-[calc(100vh-160px)] pb-[50px]">
            <div class="content-wrapper">
                <div class="container mx-auto px-4 h-full">
                    <?php if ($msg): ?>
                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4 rounded-lg shadow-sm transition-all duration-300" role="alert">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                <?php echo e($msg); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 h-full">
                        <section class="bg-white p-4 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">
                                <i class="fas fa-plus-circle mr-2"></i>Add New Task
                            </h3>
                            <div class="scrollable-content">
                                <?php require_once 'Components/add-task-form.php'; ?>
                            </div>
                        </section>

                        <section class="bg-white p-4 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">
                                <i class="fas fa-tasks mr-2"></i>Task List
                            </h3>
                            <div class="scrollable-content">
                                <?php require_once 'Components/task-list.php'; ?>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once 'Layouts/footer.php'; ?>
    </div>

    <script>
        setTimeout(function () {
            const msg = document.querySelector('[role="alert"]');
            if (msg) {
                msg.classList.add('opacity-0');
                setTimeout(() => msg.style.display = 'none', 300);
            }
        }, 3000);
    </script>
</body>
</html>