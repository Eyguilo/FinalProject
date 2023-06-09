document.addEventListener('DOMContentLoaded', function() {
    var deleteForms = document.querySelectorAll('.deleteClientForm');
    deleteForms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            var confirmed = confirm('Are you sure you want to eliminate the client?');

            if (confirmed) {
                this.submit();
            }
        });
    });
});