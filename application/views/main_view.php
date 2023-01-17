<form action="/task/post" method="post" class="card mb-4 box-shadow container">
    <div class="card-header">
        <h4 class="my-0 font-weight-normal">Task list</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <input type="text" class="form-control col-8 mr-3" name="taskDescription" placeholder="Enter text...">
            <button type="submit" class="btn btn-dark col-3" name="requestType", value="ADD_TASK">ADD TASK</button>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-dark col-4" name="requestType", value="REMOVE_ALL">REMOVE ALL</button>
            <button type="submit" class="btn btn-dark col-4" name="requestType", value="READY_ALL">READY ALL</button>
        </div>
    </div>
    <ul class="list-group">
        <?php if (isset($data['tasks'])) foreach($data['tasks'] as $task): ?>
            <li class="list-group-item">
                <div style="display: flex; justify-content: space-between">
                    <div><?php echo htmlspecialchars($task['description']); ?></div>

                    <?php if ($task['status'] == 1): ?>
                        <span class="badge badge-success">READY</span>
                    <?php else: ?>
                        <span class="badge badge-danger">NOT READY</span>
                    <?php endif; ?>
                </div>
                <div style="display: flex; justify-content: space-around;">
                    <button type="submit" class="btn btn-primary" name="requestType", value=<?php echo "CHANGE_STATUS_ONE:".$task['id'] ?>>
                        <?php 
                            if ($task['status'] == 1) 
                                echo "UNREADY"; 
                            else 
                                echo "READY"; 
                        ?>
                    </button>
                    <button type="submit" class="btn btn-danger" name="requestType", value=<?php echo "REMOVE_ONE:".$task['id'] ?>>REMOVE</button>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</form>    