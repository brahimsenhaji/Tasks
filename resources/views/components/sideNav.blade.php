<nav class="SideNav">
    <div class="logo"><h1>任務</h1></div>
    <div class="wrapper">
        <form action="" method="get">
            <div class="wrap">
                <label>Search</label>
                <input type="text" name="" id="">
            </div>
        </form>
        <div class="pined">
            <h1>pinned tasks</h1>
        </div>
        <div class="btns">
            <button id="addTask" class="btn">Add new  <i class="fa-solid fa-plus"></i></button>
            <button id="logoutButton" class="log_out">Log out  <i class="fa-solid fa-right-from-bracket"></i></button>
        </div>
    </div>
</nav>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', ()=> {
    document.getElementById('logoutButton').addEventListener('click', function() {
        fetch('/Logout', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                window.location.href = '/';
            }
        })
        .catch(error => console.error('Error:', error));
    });
    });
</script>
<script>
    function getPinedTasks() {
    $.ajax({
        url: '/Tasks/pined',
        method: 'GET',
        success: function(response) {
            console.log(response);
            response.forEach(data => {
                let pined = document.querySelector('.pined');
                let text = document.createElement('p');
                text.textContent = data.task.split(' ').slice(0, 5).join(' ');
                pined.appendChild(text);
            
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
$(document).ready(function() {
    getPinedTasks();
});

</script>