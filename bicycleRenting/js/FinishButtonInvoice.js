document.getElementById('finishInvoice').addEventListener('submit', function(event) {
    event.preventDefault();

    let confirmed = confirm('Are you sure you want to finish the booking? Means that bicycles has returned and the booking has been paid.');

    if (confirmed) {
        this.submit();
    }
});



