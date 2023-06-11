document.getElementById('eliminateInvoice').addEventListener('submit', function(event) {
    event.preventDefault();

    let confirmed = confirm('Are you sure you want to eliminate the booking?');

    if (confirmed) {
        this.submit();
    }
});



