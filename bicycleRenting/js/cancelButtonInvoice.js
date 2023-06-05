document.getElementById('cancelInvoice').addEventListener('submit', function(event) {
    event.preventDefault();

    let confirmed = confirm('Are you sure you want to cancel the booking?');

    if (confirmed) {
        this.submit();
    }
});



