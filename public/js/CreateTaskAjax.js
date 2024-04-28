
export function createTask() {
    $(document).ready(function() {
        $('#createTaskForm').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();
            $.ajax({
                url: '{{ route('createTasks_page') }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    // Handle success response here
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error response here
                }
            });
        });
    });
}
