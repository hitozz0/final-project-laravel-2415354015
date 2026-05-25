<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 700px; width: 100%; overflow: visible;">
        <div class="modal-content bg-white rounded-xl p-8 shadow-lg border-0" style="overflow: visible;">
            <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">Add Service</h2>
            <form action="{{ route('services.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block font-semibold text-gray-900 mb-2">Service Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" style="background-color: #f3f4f6; border: none; border-radius: 12px; padding: 12px 16px; width: 100%; outline: none;" placeholder="Enter service name">
                    @error('name') <div class="field-error" style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>
                <div class="mb-4">
                    <label class="block font-semibold text-gray-900 mb-2">Price</label>
                    <input type="text" name="price" value="{{ old('price') }}" style="background-color: #f3f4f6; border: none; border-radius: 12px; padding: 12px 16px; width: 100%; outline: none;" placeholder="Enter price">
                    @error('price') <div class="field-error" style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>
                <div class="mb-4">
                    <label class="block font-semibold text-gray-900 mb-2">Description</label>
                    <textarea rows="3" name="description" style="background-color: #f3f4f6; border: none; border-radius: 12px; padding: 12px 16px; width: 100%; outline: none; resize: none;" placeholder="Enter description">{{ old('description') }}</textarea>
                    @error('description') <div class="field-error" style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>
                <div class="mb-6">
                    <label class="block font-semibold text-gray-900 mb-2">Status</label>
                    <div style="position: relative;">
                        <input type="hidden" name="status" class="custom-dropdown-value" value="{{ old('status') }}">
                        <div class="custom-dropdown-trigger" data-placeholder="Select Status" onclick="toggleDropdown(this)" style="background-color: #f3f4f6; border: none; border-radius: 12px; padding: 12px 16px; width: 100%; outline: none; cursor: pointer; user-select: none; color: {{ old('status') ? '#111827' : '#6b7280' }}; min-height: 48px;">
                            {{ old('status') ? ucfirst(old('status')) : 'Select Status' }}
                        </div>
                        <svg style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); pointer-events: none; width: 20px; height: 20px; color: #6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                        <div class="custom-dropdown-options" style="display: none; position: fixed; background: white; border: 1px solid #e5e7eb; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); z-index: 99999; max-height: 200px; overflow-y: auto;">
                            <div class="custom-dropdown-option" onclick="selectOption(this, 'active', 'Active')" onmouseenter="this.style.backgroundColor='#f3f4f6'" onmouseleave="this.style.backgroundColor='white'" style="padding: 12px 16px; cursor: pointer;">Active</div>
                            <div class="custom-dropdown-option" onclick="selectOption(this, 'inactive', 'Inactive')" onmouseenter="this.style.backgroundColor='#f3f4f6'" onmouseleave="this.style.backgroundColor='white'" style="padding: 12px 16px; cursor: pointer;">Inactive</div>
                        </div>
                    </div>
                    @error('status') <div class="field-error" style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>
                <div style="display: flex; align-items: center; justify-content: flex-end; gap: 12px;">
                    <button type="button" data-bs-dismiss="modal" style="padding: 12px 24px; border: 1px solid #d1d5db; border-radius: 12px; background: white; color: #111827;">
                        Cancel
                    </button>
                    <button type="submit" style="padding: 12px 24px; border: none; border-radius: 12px; background-color: #394149; color: white;">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>