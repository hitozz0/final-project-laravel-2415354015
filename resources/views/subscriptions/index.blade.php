@extends('layout.app')

@section('title', 'Subscriptions')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div></div>
        <button type="button" data-bs-toggle="modal" data-bs-target="#addDataModal" class="inline-flex items-center gap-2 bg-primary text-white rounded-xl px-6 py-4">
            <span class="iconify" data-icon="ic:baseline-add" style="font-size: 20px;"></span>
            Add Data
        </button>
    </div>

    <div class="border border-gray-200 rounded-lg bg-white" style="overflow: visible;">
    <table class="w-full text-left" style="overflow: visible;">
        <thead>
            <tr class="border-b border-gray-200">
                <th class="px-4 py-4 font-semibold text-gray-900">Customer Name</th>
                <th class="px-4 py-4 font-semibold text-gray-900">Services</th>
                <th class="px-4 py-4 font-semibold text-gray-900">Services Period</th>
                <th class="px-4 py-4 font-semibold text-gray-900">Status</th>
                <th class="px-4 py-4 font-semibold text-gray-900 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subscriptions as $subscription)
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-4 text-gray-900">{{ $subscription['customer']['name'] ?? '-' }}</td>
                    <td class="px-4 py-4 text-gray-900">{{ $subscription['service']['name'] ?? '-' }}</td>
                    <td class="px-4 py-4 text-gray-900">
                        {{ \Carbon\Carbon::parse($subscription['start_date'])->format('d M Y') }} - {{ \Carbon\Carbon::parse($subscription['end_date'])->format('d M Y') }}
                    </td>
                    <td class="px-4 py-4">
                        @php
                            $status = ucfirst($subscription['status']);
                            $statusClasses = match(strtolower($subscription['status'])) {
                                'active' => 'bg-green-100 text-green-700',
                                'trial' => 'bg-yellow-100 text-yellow-700',
                                'isolir' => 'bg-red-100 text-red-700',
                                'dismantle' => 'bg-gray-100 text-gray-700',
                                'inactive' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100 text-gray-700',
                            };
                        @endphp
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full font-medium {{ $statusClasses }}">
                            {{ $status }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-center" style="position: relative;">
                        <button class="flex justify-center w-full text-gray-500 hover:text-gray-700 action-toggle">
                            <span class="iconify" data-icon="ic:baseline-menu" style="font-size: 24px;"></span>
                        </button>
                        <div class="action-dropdown" style="display: none; position: absolute; right: 16px; top: 100%; background: white; border: 1px solid #e5e7eb; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -4px rgba(0,0,0,0.1); z-index: 9999; min-width: 260px; padding: 8px 0;">
                            <form action="{{ route('subscriptions.activate', $subscription['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #111827; white-space: nowrap; width: 100%; border: none; background: transparent;" onmouseenter="this.style.backgroundColor='#f3f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                                    <span class="iconify" data-icon="material-symbols:key" style="font-size: 22px;"></span>
                                    <span>Active</span>
                                </button>
                            </form>
                            <form action="{{ route('subscriptions.deactivate', $subscription['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #111827; white-space: nowrap; width: 100%; border: none; background: transparent;" onmouseenter="this.style.backgroundColor='#f3f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                                    <span class="iconify" data-icon="material-symbols:key-off" style="font-size: 22px;"></span>
                                    <span>Deactivate</span>
                                </button>
                            </form>
                            <form action="{{ route('subscriptions.trial', $subscription['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #111827; white-space: nowrap; width: 100%; border: none; background: transparent;" onmouseenter="this.style.backgroundColor='#f3f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                                    <span class="iconify" data-icon="material-symbols:hourglass-top" style="font-size: 22px;"></span>
                                    <span>Trial</span>
                                </button>
                            </form>
                            <form action="{{ route('subscriptions.isolir', $subscription['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #111827; white-space: nowrap; width: 100%; border: none; background: transparent;" onmouseenter="this.style.backgroundColor='#f3f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                                    <span class="iconify" data-icon="material-symbols:stop-circle-outline-rounded" style="font-size: 22px;"></span>
                                    <span>Isolir</span>
                                </button>
                            </form>
                            <form action="{{ route('subscriptions.dismantle', $subscription['id']) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #111827; white-space: nowrap; width: 100%; border: none; background: transparent;" onmouseenter="this.style.backgroundColor='#f3f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                                    <span class="iconify" data-icon="material-symbols:dangerous" style="font-size: 22px;"></span>
                                    <span>Dismantle</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 700px; width: 100%; overflow: visible;">
            <div class="modal-content bg-white rounded-xl p-8 shadow-lg border-0" style="overflow: visible;">
                <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">Add Subscription</h2>
                @include('subscriptions.create')
            </div>
        </div>
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

        if (spaceBelow < 250) {
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

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('addDataModal');

    modal.addEventListener('show.bs.modal', function() {
        const startInput = document.getElementById('start_date');
        const endInput = document.getElementById('end_date');

        if (startInput._flatpickr) startInput._flatpickr.destroy();
        if (endInput._flatpickr) endInput._flatpickr.destroy();

        document.querySelectorAll('.flatpickr-calendar').forEach(el => el.remove());

        flatpickr(startInput, { dateFormat: 'd/m/Y', appendTo: modal });
        flatpickr(endInput, { dateFormat: 'd/m/Y', appendTo: modal });
    });

    modal.addEventListener('hidden.bs.modal', function() {
        const startInput = document.getElementById('start_date');
        const endInput = document.getElementById('end_date');

        if (startInput._flatpickr) startInput._flatpickr.destroy();
        if (endInput._flatpickr) endInput._flatpickr.destroy();

        document.querySelectorAll('.flatpickr-calendar').forEach(el => el.remove());

        startInput.value = '';
        endInput.value = '';

        modal.querySelectorAll('input[type="text"], input[type="email"]').forEach(el => el.value = '');
        modal.querySelectorAll('.custom-dropdown-value').forEach(el => el.value = '');
        modal.querySelectorAll('.custom-dropdown-trigger').forEach(el => {
            el.style.color = '#6b7280';
            const placeholder = el.getAttribute('data-placeholder');
            if (placeholder) el.textContent = placeholder;
        });
    });
});

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
    modal.querySelectorAll('input[type="text"]').forEach(el => {
        el.addEventListener('input', function() {
            this.style.border = 'none';
            const err = this.parentElement.querySelector('.field-error');
            if (err) err.remove();
        }, { once: true });
    });
}
</script>
@endpush
