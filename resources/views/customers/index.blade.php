@extends('layout.app')
@section('title', 'Customers')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <button data-bs-toggle="modal" data-bs-target="#addDataModal" class="rounded-md border border-slate-300 py-2 px-4 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 active:border-slate-800 active:text-white active:bg-slate-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
             add data
        </button>
    </div>
<div class="relative flex flex-col w-full h-full overflow-scroll text-slate-300 bg-slate-800 shadow-md rounded-lg bg-clip-border">
<table class="w-full text-left table-auto min-w-max">
    <thead>
        <tr>
            <th class="p-4 border-b border-slate-600 bg-slate-700">
                <p class="text-sm font-normal leading-none text-slate-300">
                    Cust ID
                </p>
            </th>
            <th class="p-4 border-b border-slate-600 bg-slate-700">
                <p class="text-sm font-normal leading-none text-slate-300">
                    Name
                </p>
            </th>
            <th class="p-4 border-b border-slate-600 bg-slate-700">
                <p class="text-sm font-normal leading-none text-slate-300">
                    Email
                </p>
            </th>
            <th class="p-4 border-b border-slate-600 bg-slate-700">
                <p class="text-sm font-normal leading-none text-slate-300">
                    Phone
                </p>
            </th>
            <th class="p-4 border-b border-slate-600 bg-slate-700">
                <p class="text-sm font-normal leading-none text-slate-300">
                    address
                </p>
            </th>
            <th class="p-4 border-b border-slate-600 bg-slate-700">
                <p class="text-sm font-normal leading-none text-slate-300">
                    status
                </p>
            </th>
            <th class="p-4 border-b border-slate-600 bg-slate-700">
                <p class="text-sm font-normal leading-none text-slate-300">
                    action
                </p>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer )    
        <tr class="hover:bg-slate-700">
            <td class="p-4 border-b border-slate-700">
                <p class="text-sm text-slate-100 font-semibold">
                    {{ $customer['customer_id'] }}
                </p>
            </td>
            <td class="p-4 border-b border-slate-700">
                <p class="text-sm text-slate-100 font-semibold">
                    {{ $customer['name'] }}
                </p>
            </td>
            <td class="p-4 border-b border-slate-700">
                <p class="text-sm text-slate-100 font-semibold">
                    {{ $customer['email'] }}
                </p>
            </td>
            <td class="p-4 border-b border-slate-700">
                <p class="text-sm text-slate-100 font-semibold">
                    {{ $customer['phone'] }}
                </p>
            </td>
            <td class="p-4 border-b border-slate-700">
                <p class="text-sm text-slate-100 font-semibold">
                    {{ $customer['address'] }}
                </p>
            </td>
            <<td class="px-4 py-4">
                <span class="inline-flex items-center px-3 py-0.5 rounded-full font-medium {{ $customer['status'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $customer['status'] ? 'Active' : 'Inactive' }}
                </span>
            </td>
            <td class="px-4 py-4 text-center" style="position: relative; overflow: visible;">
                        <button class="flex justify-center w-full text-gray-500 hover:text-gray-700 action-toggle">
                            <span class="iconify" data-icon="ic:baseline-menu" style="font-size: 24px;"></span>
                        </button>
                        <div class="action-dropdown" data-id="{{ $customer['id'] }}" data-customer-id="{{ $customer['customer_id'] }}" data-name="{{ $customer['name'] }}" data-email="{{ $customer['email'] }}" data-phone="{{ $customer['phone'] ?? '' }}" data-address="{{ $customer['address'] }}" data-status="{{ $customer['status'] ? 'active' : 'inactive' }}" style="display: none; position: absolute; right: 16px; top: 100%; background: white; border: 1px solid #e5e7eb; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -4px rgba(0,0,0,0.1); z-index: 9999; min-width: 200px; padding: 8px 0;">
                            <form action="{{ route('customers.activate', $customer['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #111827; white-space: nowrap; width: 100%; border: none; background: transparent;" onmouseenter="this.style.backgroundColor='#f3f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                                    <span class="iconify" data-icon="material-symbols:key" style="font-size: 22px;"></span>
                                    <span>Active</span>
                                </button>
                            </form>
                            <form action="{{ route('customers.deactivate', $customer['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #111827; white-space: nowrap; width: 100%; border: none; background: transparent;" onmouseenter="this.style.backgroundColor='#f3f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                                    <span class="iconify" data-icon="material-symbols:key-off" style="font-size: 22px;"></span>
                                    <span>Deactivate</span>
                                </button>
                            </form>
                            <div onclick="openEditModal(this)" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #111827; white-space: nowrap;" onmouseenter="this.style.backgroundColor='#f3f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                                <span class="iconify" data-icon="boxicons:edit" style="font-size: 22px;"></span>
                                <span>Edit</span>
                            </div>
                            <div onclick="openDeleteModal(this)" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #ef4444; white-space: nowrap;" onmouseenter="this.style.backgroundColor='#f3f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                                <span class="iconify" data-icon="material-symbols:delete" style="font-size: 22px;"></span>
                                <span>Delete</span>
                            </div>
                        </div>
                    </td>
        </tr>
        @include('customers.create')
        @include('customers.edit')
        @include('customers.delete')
        @endforeach
    </tbody>
  </table>
</div>
 
@endsection
@push('scripts')
<script>
function toggleDropdown(el) {
    const options = el.nextElementSibling.nextElementSibling;
    const isVisible = options.style.display === 'block';

    document.querySelectorAll('.custom-dropdown-options').forEach(o => o.style.display = 'none');

    if (!isVisible) {
        const triggerRect = el.getBoundingClientRect();
        const spaceBelow = window.innerHeight - triggerRect.bottom;

        options.style.position = 'fixed';
        options.style.width = triggerRect.width + 'px';
        options.style.left = triggerRect.left + 'px';
        options.style.zIndex = '99999';
        options.style.display = 'block';

        if (spaceBelow < 120) {
            options.style.top = 'auto';
            options.style.bottom = (window.innerHeight - triggerRect.top + 4) + 'px';
        } else {
            options.style.bottom = 'auto';
            options.style.top = (triggerRect.bottom + 4) + 'px';
        }
    }
}

function selectOption(el, value, label) {
    const wrapper = el.closest('[style*="position: relative"]');
    const trigger = wrapper.querySelector('.custom-dropdown-trigger');
    const input = wrapper.querySelector('.custom-dropdown-value');
    const options = wrapper.querySelector('.custom-dropdown-options');
    trigger.textContent = label;
    trigger.style.color = '#111827';
    input.value = value;
    options.style.display = 'none';
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.custom-dropdown-trigger')) {
        document.querySelectorAll('.custom-dropdown-options').forEach(el => {
            el.style.display = 'none';
        });
    }
    if (!e.target.closest('.action-toggle') && !e.target.closest('.action-dropdown')) {
        document.querySelectorAll('.action-dropdown').forEach(el => {
            el.style.display = 'none';
        });
    }
});

document.querySelectorAll('.action-toggle').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const dropdown = this.nextElementSibling;
        const isOpen = dropdown.style.display === 'block';

        document.querySelectorAll('.action-dropdown').forEach(el => { el.style.display = 'none'; });

        if (!isOpen) {
            const btnRect = this.getBoundingClientRect();
            const spaceBelow = window.innerHeight - btnRect.bottom;

            if (spaceBelow < 300) {
                dropdown.style.top = 'auto';
                dropdown.style.bottom = '100%';
            } else {
                dropdown.style.bottom = 'auto';
                dropdown.style.top = '100%';
            }

            dropdown.style.display = 'block';
        }
    });
});

document.getElementById('addDataModal').addEventListener('hidden.bs.modal', function() {
    const modal = this;
    modal.querySelectorAll('input[type="text"], input[type="email"]').forEach(el => { el.value = ''; });
    modal.querySelectorAll('.custom-dropdown-value').forEach(el => { el.value = ''; });
    modal.querySelectorAll('.custom-dropdown-trigger').forEach(el => {
        el.style.color = '#6b7280';
        const placeholder = el.getAttribute('data-placeholder');
        if (placeholder) el.textContent = placeholder;
    });
});

function openEditModal(el) {
    const dropdown = el.closest('.action-dropdown');
    document.getElementById('edit_customer_db_id').value = dropdown.dataset.id;
    document.getElementById('edit_customer_id').value = dropdown.dataset.customerId;
    document.getElementById('edit_customer_name').value = dropdown.dataset.name;
    document.getElementById('edit_customer_email').value = dropdown.dataset.email;
    document.getElementById('edit_customer_phone').value = dropdown.dataset.phone;
    document.getElementById('edit_customer_address').value = dropdown.dataset.address;
    const status = dropdown.dataset.status;
    const statusInput = document.getElementById('edit_customer_status');
    statusInput.value = status;
    const trigger = statusInput.nextElementSibling;
    trigger.textContent = status === 'active' ? 'Active' : 'Inactive';
    trigger.style.color = '#111827';

    document.getElementById('editCustomerForm').action = '/customers/' + dropdown.dataset.id;

    dropdown.style.display = 'none';
    new bootstrap.Modal(document.getElementById('editDataModal')).show();
}

function openDeleteModal(el) {
    const dropdown = el.closest('.action-dropdown');
    document.getElementById('delete_customer_name').textContent = dropdown.dataset.name;
    document.getElementById('deleteCustomerForm').action = '/customers/' + dropdown.dataset.id;
    dropdown.style.display = 'none';
    new bootstrap.Modal(document.getElementById('deleteDataModal')).show();
}

function clearErrors(modal) {
    modal.querySelectorAll('.field-error').forEach(el => el.remove());
    modal.querySelectorAll('[style*="border: 1px solid #ef4444"]').forEach(el => {
        el.style.border = 'none';
    });
    modal.querySelectorAll('.custom-dropdown-trigger[style*="border: 1px solid #ef4444"]').forEach(el => {
        el.style.border = 'none';
    });
}

function showFieldError(field, message) {
    const existing = field.parentElement.querySelector('.field-error');
    if (existing) existing.remove();
    const err = document.createElement('div');
    err.className = 'field-error';
    err.style.cssText = 'color: #ef4444; font-size: 13px; margin-top: 4px;';
    err.textContent = message;
    field.style.border = '1px solid #ef4444';
    field.parentElement.appendChild(err);
}

function attachInputListeners(modal) {
    modal.querySelectorAll('input[type="text"], input[type="email"]').forEach(el => {
        el.addEventListener('input', function() {
            this.style.border = 'none';
            const err = this.parentElement.querySelector('.field-error');
            if (err) err.remove();
        }, { once: true });
    });
}
</script>
@endpush