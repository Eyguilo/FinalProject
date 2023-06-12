document.addEventListener('DOMContentLoaded', function() {
    var deleteForms = document.querySelectorAll('.deleteUserForm');
    deleteForms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            var confirmed = confirm('Are you sure you want to eliminate the user?');

            if (confirmed) {
                this.submit();
            }
        });
    });
});
