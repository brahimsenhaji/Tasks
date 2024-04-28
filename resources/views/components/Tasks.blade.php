<section class="Tasks">
 <h1>Your Tasks</h1>
 <div class="tasksConiner">
    @php
        $number = 1;
    @endphp
    @foreach ($tasks as $task)
     <div class="cards" data-task-id="{{ $task->id }}">
        <div class="moreButtons">
            <i class="fa-solid fa-pen-to-square"></i>
            <i class="fa-solid fa-thumbtack" onclick="pinTask({{ $task->id }})"></i>
            <i class="fa-solid fa-trash" onclick="deleteTask({{ $task->id }})"></i>
         </div>

         <div class="more">
            @php
                $condation = '';
            @endphp
            @foreach ($more as $mo)
                @if ($mo->task_id == $task->id)
                    @php
                        $condation = $mo->done == 'yes' ? 'checked' : '';
                    @endphp
                @endif
            @endforeach
            <input type="checkbox" data-task-id="{{ $task->id }}" {{ $condation }}>
        </div>
        

        <div class="tasknumber">
            <h1>{{$number}}</h1>
        </div>
        <p class="text">
            {{implode(' ', array_slice(str_word_count($task->task, 1), 0, 15))}}
            
            {{ str_word_count($task->task) > 15 ? '...' : '' }}
        </p>
     </div>
    <div hidden >{{$number++;}}</div>
    @endforeach
 </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
let cards = document.querySelectorAll('.cards');

cards.forEach(card => {
    card.addEventListener('click', () => {
        document.querySelectorAll('.moreButtons').forEach(more => {
            more.classList.remove('Showmore');
        });

        let moreButton = card.querySelector('.moreButtons');
        moreButton.classList.toggle('Showmore');
    });
});
</script>
<script>
    

    function deleteTask(taskId) {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/Tasks/' + taskId,
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function(response) {
            console.log(response);
            document.querySelector('.cards[data-task-id="' + taskId + '"]').remove();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function pinTask(taskId) {
    location.reload();

    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/Tasks/pin/' + taskId,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function(response) {
            console.log(response);

        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

$('input[type="checkbox"]').change(function() {
    var isChecked = this.checked ? 1 : 0;
    var taskId = $(this).data('task-id');
    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/Tasks/pin/' + taskId + '/update',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {isChecked: isChecked},
        success: function(response) {
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

</script>