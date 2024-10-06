<x-layout>
    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Customer Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="company">Company:</label>
            <input type="text" id="company" name="company">
        </div>
        <div>
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" required>
        </div>
        <div>
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="active" selected>Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <div id="addresses">
            <label for="address">Address:</label>
            <input type="text" name="addresses[]" required>
        </div>

        <button type="button" onclick="addAddress()">Add Address</button>
        <button type="submit">Submit</button>
    </form>

    <script>
        function addAddress() {
            const addressesDiv = document.getElementById('addresses');
            const input = document.createElement('input');
            input.setAttribute('type', 'text');
            input.setAttribute('name', 'addresses[]');
            input.required = true;
            addressesDiv.appendChild(input);
        }
    </script>
</x-layout>
