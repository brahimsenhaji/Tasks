<div class="continer">
    <form id="createTaskForm" action="{{route('createTasks_page')}}" method="POST">
        @csrf
        <div class="head"><i class="fa-solid fa-x" id="close"></i></div>
        <textarea name="task" id="" class="text" ></textarea>
        <button type="submit" class="save_btn">Save</button>
    </form>
</div>
<div class="Message">
    <p>Are you sure you want to exit without saving</p>
    <div>
        <button class="Nobutton">No</button>
        <button class="YesButton">Yes</button>
    </div>
</div>
<script src="CreateTaskAjax.js"></script>
<script>
    let TasksForm = document.querySelector('.continer');
    document.getElementById('addTask').addEventListener('click', ()=> {
        TasksForm.style.display = 'block';
    });

    let close = document.querySelector('#close');
    let text = document.querySelector('.text');
    close.addEventListener('click', ()=> {
        if (!text.value.trim()) {
            TasksForm.style.display = 'none';
        }
        else{
            let Message = document.querySelector('.Message');
            Message.style.display = 'block';

            let YesButton = document.querySelector('.YesButton');
            YesButton.addEventListener('click', ()=>{
                Message.style.display = 'none';
                TasksForm.style.display = 'none';
            });
            let Nobutton = document.querySelector('.Nobutton');
            Nobutton.addEventListener('click', ()=>{
                Message.style.display = 'none';
            });
        }
    });

    createTask();
</script>