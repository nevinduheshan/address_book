<x-layout>
    <div class="container mx-auto mt-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Customer List</h1>

            <!-- Add Customer Button -->
            <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded" data-modal-target="addCustomerModal"
                data-modal-toggle="addCustomerModal">
                Add Customer
            </button>
        </div>

        <!-- Customer List Table -->
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Company</th>
                    <th class="border px-4 py-2">Phone</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Country</th>
                    <th class="border px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr class="cursor-pointer" onclick="toggleDetails({{ $customer->id }})">
                        <td class="border px-4 py-2">{{ $customer->name }}</td>
                        <td class="border px-4 py-2">{{ $customer->company }}</td>
                        <td class="border px-4 py-2">{{ $customer->phone }}</td>
                        <td class="border px-4 py-2">{{ $customer->email }}</td>
                        <td class="border px-4 py-2">{{ $customer->country }}</td>
                        <td class="border px-4 py-2">
                            @if ($customer->status == 'active')
                                <span class="text-green-500 font-semibold">Active</span>
                            @else
                                <span class="text-red-500 font-semibold">Inactive</span>
                            @endif
                        </td>
                    </tr>
                    <tr id="details-{{ $customer->id }}" class="hidden">
                        <td colspan="6" class="border px-4 py-2">
                            <div class="bg-gray-100 p-4">
                                <h3 class="text-lg font-semibold">Customer Details</h3>
                                <p><strong>Status:</strong> {{ $customer->status }}</p>
                                <h4 class="font-semibold mt-2">Addresses:</h4>
                                <ul class="list-disc ml-6">
                                    @foreach ($customer->addresses as $address)
                                        <li>{{ $address->address }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $customers->links() }}
        </div>

        <!-- Add Customer Modal -->
        <div id="addCustomerModal"
            class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow p-6 w-full max-w-lg">
                <h2 class="text-xl font-bold mb-4">Add Customer</h2>

                <form method="POST" action="{{ route('customers.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block font-semibold">Customer Name</label>
                        <input type="text" name="name" id="name" class="border w-full p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="company" class="block font-semibold">Company</label>
                        <input type="text" name="company" id="company" class="border w-full p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block font-semibold">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="border w-full p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block font-semibold">Email</label>
                        <input type="email" name="email" id="email" class="border w-full p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="country" class="block font-semibold">Country</label>
                        <input type="text" name="country" id="country" class="border w-full p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block font-semibold">Status</label>
                        <select name="status" id="status" class="border w-full p-2 rounded">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Address Section -->
                    <div class="mb-4">
                        <label class="block font-semibold">Address</label>
                        <div class="flex space-x-2 items-center address-section">
                            <input type="text" name="addresses[]" class="border w-full p-2 rounded" required>
                            <button type="button" class="bg-red-500 text-white px-2 py-1 rounded delete-address"
                                onclick="removeAddress(this)" style="display: none;">Delete</button>
                        </div>

                    </div>



                    <div id="extra-addresses"></div>

                    <button type="button" class="bg-blue-500 text-white px-2 py-1 mt-2 rounded"
                            onclick="addAddress()">Add More Address</button>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded ml-2"
                            data-modal-toggle="addCustomerModal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        function toggleDetails(customerId) {
            const detailsRow = document.getElementById(`details-${customerId}`);
            document.querySelectorAll('tr[id^="details-"]').forEach(row => {
                if (row !== detailsRow) row.classList.add('hidden');
            });
            detailsRow.classList.toggle('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Check on page load if we need to hide/show the delete button
            toggleDeleteButtons();
        });

        function addAddress() {
            const newAddress = `
        <div class="flex space-x-2 items-center address-section mb-4">
            <input type="text" name="addresses[]" class="border w-full p-2 rounded" required>
            <button type="button" class="bg-red-500 text-white px-2 py-1 rounded delete-address" onclick="removeAddress(this)">Delete</button>
        </div>`;
            document.getElementById('extra-addresses').insertAdjacentHTML('beforeend', newAddress);

            // After adding a new address, check the number of address sections
            toggleDeleteButtons();
        }

        function removeAddress(button) {
            button.closest('div').remove();

            // After removing an address, check the number of address sections
            toggleDeleteButtons();
        }

        function toggleDeleteButtons() {
            const addressSections = document.querySelectorAll('.address-section');
            const deleteButtons = document.querySelectorAll('.delete-address');

            // Show the "Delete" button only if there are more than 1 address fields
            if (addressSections.length > 1) {
                deleteButtons.forEach(button => {
                    button.style.display = 'inline-block';
                });
            } else {
                deleteButtons.forEach(button => {
                    button.style.display = 'none';
                });
            }
        }
    </script>
</x-layout>
