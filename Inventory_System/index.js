const itemForm = document.getElementById('itemForm');
        const inventoryTable = document.getElementById('inventoryTable').getElementsByTagName('tbody')[0];
        let itemId = 11; // Start item ID at 11 since we already have 10 items in the table

        itemForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting

            // Get values from the form
            const itemName = document.getElementById('itemName').value;
            const itemQuantity = document.getElementById('itemQuantity').value;
            const itemPrice = document.getElementById('itemPrice').value;

            // Create a new row in the inventory table
            const newRow = inventoryTable.insertRow();
            newRow.innerHTML = `
                <td>${itemId++}</td>
                <td>${itemName}</td>
                <td>${itemQuantity}</td>
                <td>$${parseFloat(itemPrice).toFixed(2)}</td>
                <td><button class="item-button" onclick="goToItemPage(${itemId - 1})">View</button></td>
            `;

            // Clear the form inputs
            itemForm.reset();
        });

        function goToItemPage(id) {
            // Redirect to a specific item page
            window.location.href = item.html?id=$:{id};
        }