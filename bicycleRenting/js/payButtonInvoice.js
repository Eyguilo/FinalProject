document.getElementById('payInvoice').addEventListener('submit', function(event) {
    event.preventDefault();

    let confirmed = confirm('Are you sure you want to confirm the payment?');

    if (confirmed) {
        this.submit();
    }
});



