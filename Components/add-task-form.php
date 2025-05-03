<div class="bg-white rounded-lg  mb-8">
    <div class="p-6">
        <form method="POST">
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" name="create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create Task</button>
        </form>
    </div>
</div> 