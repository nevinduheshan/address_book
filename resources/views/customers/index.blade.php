<x-layout>
    <div class="container mx-auto mt-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Customer List</h1>

            <!-- Add Customer Button -->
            <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                data-modal-target="addCustomerModal" data-modal-toggle="addCustomerModal">
                Add Customer
            </button>
        </div>


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Customer name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Company
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Phone
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Country
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr onclick="toggleDetails({{ $customer->id }})"
                            class="bg-white cursor-pointer border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $customer->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $customer->company }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $customer->phone }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $customer->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $customer->country }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($customer->status == 'active')
                                    <span class="focus:outline-none text-green-700 bg-green-200 hover:bg-green-300 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Active</span>
                                @else
                                    <span class="focus:outline-none text-red-800 bg-red-200 hover:bg-red-300 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Inactive</span>
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
        </div>


        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $customers->links() }}
        </div>

        <!-- Project List Button -->
        <a href="{{ route('projects.index') }}"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Project List
        </a>

        <!-- Add Customer Modal -->
        <div id="addCustomerModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow p-6 w-full max-w-lg">
                <h2 class="text-xl font-bold mb-4">Add Customer</h2>

                <form class="max-w-sm mx-auto" method="POST" action="{{ route('customers.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                        <input type="text" name="company" id="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                        <input type="text" name="country" id="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Address Section -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <div class="flex space-x-2 items-center address-section">
                            <input type="text" name="addresses[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <button type="button" class="bg-green-500 text-white px-2 py-1 rounded delete-address"
                                onclick="removeAddress(this)" style="display: none;">Delete</button>
                        </div>

                    </div>



                    <div id="extra-addresses"></div>

                    <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                        onclick="addAddress()">Add</button>

                    <div class="flex justify-end">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
                        <button type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
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
            <button type="button" class="bg-green-500 text-white px-2 py-1 rounded delete-address" onclick="removeAddress(this)">Delete</button>
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
