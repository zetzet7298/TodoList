<div id="myDIV" class="header">
    <h2 style="margin:5px">My To Do List</h2>
    <div class="row">
        <div class="col-6">
            <label for="work">Work: </label>
            <input type="text" class="form-control" id="work">
        </div>
        <div class="col-3">
            <label>Starting Date: </label>
            <input type="date" class="form-control" id="startingDate">
        </div>
        <div class="col-3">
            <label>Ending Date: </label>
            <input type="date" class="form-control" id="endingDate">
        </div>
    </div>
    <span onclick="newElement()" class="addBtn">Add</span>
</div>

<ul id="myUL">
    <li class="todo-item">Hit the gym</li>
    <li class="checked todo-item">Pay bills</li>
    <li class="todo-item">Meet George</li>
    <li class="todo-item">Buy eggs</li>
    <li class="todo-item">Read a book</li>
    <li class="todo-item">Organize office</li>
</ul>