<div class="modal fade" id="deleteDataModal" tabindex="-1" aria-labelledby="deleteDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px; width: 100%;">
        <div class="modal-content bg-white rounded-xl p-8 shadow-lg border-0 text-center">
            <div class="flex justify-center mb-4">
                <span class="iconify" data-icon="ion:warning-outline" style="font-size: 64px; color: #ef4444;"></span>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Delete Data</h2>
            <p class="text-gray-700 mb-6">Are you sure you want to delete <span id="delete_service_name" class="font-semibold"></span>?</p>
            <form id="deleteServiceForm" action="" method="POST">
                @csrf
                @method('DELETE')
                <div style="display: flex; align-items: center; justify-content: center; gap: 12px;">
                    <button type="button" data-bs-dismiss="modal" style="padding: 12px 24px; border: 1px solid #d1d5db; border-radius: 12px; background: white; color: #111827;">
                        Cancel
                    </button>
                    <button type="submit" style="padding: 12px 24px; border: none; border-radius: 12px; background-color: #ef4444; color: white;">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>