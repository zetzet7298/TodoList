<ul id="myUL">
    <?php if(!empty($data)): ?>
        <?php foreach ($data as $k => $work):?>
            <li class="todo-item" id=<?= "'" . $work['id'] . "'"; ?>>
                <span id="workName"><?= $work['work_name']; ?></span>
                <span id="startingDate" value="<?= $work['work_starting_date']; ?>">
                (<?= date('d-m-Y H:i:s', $work['work_starting_date']); ?>)
                </span>
                -
                <span id="endingDate" value="<?= $work['work_ending_date']; ?>">
                (<?= date('d-m-Y H:i:s',$work['work_ending_date']); ?>)
                </span>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>