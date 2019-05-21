<?php
namespace MyTask;

require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/fun.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/MyGraid/my_logic.php');

use SecondEx\UseCurl;

/**
 * Class Task
 * @package MyTask
 */
class Task {
    use UseCurl;
    public function add_task($element_id){
        $data['add'][] = [
            'element_id' => $element_id,
            'element_type' => '1',
            'complete_till' => '1559307600',
            'task_type' => '1',
            'text' => 'Текст задачи',
            'responsible_user_id' => '3460870',
                        ];
        $this->data = $data;
        $this->type = 'api/v2/tasks';
        $this->use_curl(TRUE);
        pre($this->result);
    }
    public function get_list_tasks(){
        $this->type = 'api/v2/tasks';
        $this->use_curl();
    }
    public function update_task($task_id){
        $this->data['update'][] = [
            'id' => $task_id,
            'updated_at' => '1559318400',
            'text' => 'Текст выполненной задачи',
            'is_completed' => '1',
        ];
        $this->type = 'api/v2/tasks';
        $this->use_curl(TRUE);
    }
}