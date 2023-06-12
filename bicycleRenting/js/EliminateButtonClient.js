document.getElementById('deleteClientForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let confirmed = confirm('Are you sure you want to eliminate the client? You will eliminate all the relationated bookings and invoices.');

    if (confirmed) {
        this.submit();
    }
});



