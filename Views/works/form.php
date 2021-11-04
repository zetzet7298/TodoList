<form id="work-form" method="post" action="?controller=work&action=store">
    <div class="row">
        <div class="col-6">
            <label for="work">Work: </label>
            <input type="text" class="form-control" name="workName"><br>
            <?php if(!empty($_SESSION['workNameErr'])): ?>
                <span class="err"><?= $_SESSION['workNameErr']; ?></span>
            <?php endif; ?>
        </div>
        <div class="col-3">
            <label>Starting Date: </label>
            <input type="datetime-local" class="form-control" name="startingDate"><br>
            <?php if(!empty($_SESSION['startingDateErr'])): ?>
                <span class="err"><?= $_SESSION['startingDateErr']; ?></span>
            <?php endif; ?>
        </div>
        <div class="col-3">
            <label>Ending Date: </label>
            <input type="datetime-local" class="form-control" name="endingDate"><br>
            <?php if(!empty($_SESSION['endingDateErr'])): ?>
                <span class="err"><?= $_SESSION['endingDateErr']; ?></span>
            <?php endif; ?>
        </div>
    </div>
    <input type="submit" onclick="newElement()" value="Add" id="addBtn" class="addBtn"></input>
</form>