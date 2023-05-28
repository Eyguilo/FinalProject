document.getElementById('createBookingForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let confirmed = confirm('Are you sure you want to create booking?');

    if (confirmed) {
        this.submit();
    }
});
