<?php
class major{

    public $base_url = 'http://localhost/sma';
	public $connect;
	public $query;
	public $statement;
	public $now;
    public $today;
    public $now_in_ts;

	function __construct()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=sma", "root", "");

		date_default_timezone_set('Europe/London');

		session_start();

		$this->now = date("H:i:s",  STRTOTIME(date('h:i:sa')));

		$this->today = date("Y-m-d");

        $this->now_in_ts = date("Y-m-d H:i:s");




	}

    function execute($data = null)
	{
		try{
		$this->statement = $this->connect->prepare($this->query);
		if($data)
		{
			$this->statement->execute($data);
		}
		else
		{
			$this->statement->execute();
		}		
	}catch(PDOException $e){
     $e->getMessage();
	}

	}

	function row_count()
	{
		return $this->statement->rowCount();
	}

	function statement_result()
	{
		return $this->statement->fetchAll();
	}

	function get_result()
	{
		return $this->connect->query($this->query, PDO::FETCH_ASSOC);

	}

//  function to  chck if user has marked attendance today
    function check_today_attedance(){
        $today = $this->today;
        $this->query="
        SELECT * FROM attendance WHERE (date LIKE '$today%') AND (emp_id='$_SESSION[ID]')
        ";
        $this->execute();
        $count = $this->row_count();
        if($count == 0){
            return 0;
        }else{
            return 1;
        }

    }

    // function to get the punch in timestamp of user
    function get_punch_in_time(){

        $today = $this->today;
        $this->query="
        SELECT * FROM attendance WHERE  (date LIKE '$today%') AND emp_id='$_SESSION[ID]'
        ";
        $this->execute();
        $row = $this->get_result();
        foreach($row as $res){
            return $res['date'];
        }
       
    }
    // function to get employee name
    function get_employee_name($id){

        $today = $this->today;
        $this->query="
        SELECT * FROM employee WHERE  id='$id'
        ";
        $this->execute();
        $row = $this->get_result();
        foreach($row as $res){
            return $res['name'];
        }
       
    }
    //function to get employee profile picture
    function get_employee_picture($id){

       // $today = $this->today;
        $this->query="
        SELECT * FROM employee WHERE  id='$id'
        ";
        $this->execute();
        $row = $this->get_result();
        foreach($row as $res){
            return $res['picture'];
        }
       
    }
    // function to get employee department
    function get_employee_dept($id){

        $today = $this->today;
        $this->query="
        SELECT * FROM employee WHERE  id='$id'
        ";
        $this->execute();
        $row = $this->get_result();
        foreach($row as $res){
            return $res['department'];
        }
       
    }

    // function to gete employee Id
    function get_employee_id($id){

        $today = $this->today;
        $this->query="
        SELECT * FROM employee WHERE  id='$id'
        ";
        $this->execute();
        $row = $this->get_result();
        foreach($row as $res){
            return $res['empID'];
        }
       
    }
    // function to get employee department
    function get_employee_join_date($id){

        $today = $this->today;
        $this->query="
        SELECT * FROM employee WHERE  id='$id'
        ";
        $this->execute();
        $row = $this->get_result();
        foreach($row as $res){
            return $res['joiningDate'];
        }
       
    }
    function get_employee_phone($id){

        $today = $this->today;
        $this->query="
        SELECT * FROM employee WHERE  id='$id'
        ";
        $this->execute();
        $row = $this->get_result();
        foreach($row as $res){
            return $res['phone'];
        }
       
    }
    function get_employee_email($id){

        $today = $this->today;
        $this->query="
        SELECT * FROM employee WHERE  id='$id'
        ";
        $this->execute();
        $row = $this->get_result();
        foreach($row as $res){
            return $res['email'];
        }
       
    }

    // function to get employee punch in time
    function get_employee_punch_in_time($id){

        $today = $this->today;
        $this->query="
        SELECT * FROM `attendance` WHERE emp_id='$id' ORDER BY id DESC LIMIT 1
        ";
        $this->execute();
        $row = $this->get_result();
        foreach($row as $res){
            return $res['time_in'];
        }
       
    }

    // function to get the time in of user
    function get_time_in(){

        $today = $this->today;
        $this->query="
        SELECT * FROM attendance WHERE  (date LIKE '$today%') AND emp_id='$_SESSION[ID]'
        ";
        $this->execute();
        $row = $this->get_result();
        foreach($row as $res){
            return $res['time_in'];
        }
       
    }

    // function to get the time out status of user
    function get_time_out_status(){

        $today = $this->today;
        $this->query="
        SELECT * FROM attendance WHERE  (date LIKE '$today%') AND emp_id='$_SESSION[ID]'
        ";
        $this->execute();
        $row = $this->get_result();
        foreach($row as $res){
            return $res['time_out'];
        }
       
    }

    // function to get the time out status of user
    function get_punch_out_status(){

        $today = $this->today;
        $this->query="
        SELECT * FROM attendance WHERE  (date LIKE '$today%') AND emp_id='$_SESSION[ID]'
        ";
        $this->execute();
        $row = $this->get_result();
        foreach($row as $res){
            $time_out = $res['time_out'];
            if($time_out =='NULL'){
                return 0;
            }else{
                return 1;
            }
        }
       
    }

// function to get time since login
function GetTimeDiff($timestamp) 
{
    $how_log_ago = '';
    $minutes = 0;
    $hours  =0;
    $seconds = time() - $timestamp; 
    $minutes = (int)($seconds / 60);
    $hours = (int)($minutes / 60);
    $days = (int)($hours / 24);
    if ($days >= 1) {
      $how_log_ago = $days . ' day' . ($days != 1 ? 's' : '');
    } else if ($hours >= 1) {
      $how_log_ago = $hours . ' hour' . ($hours != 1 ? 's' : '');
    } else if ($minutes >= 1) {
      $how_log_ago = $minutes . ' minute' . ($minutes != 1 ? 's' : '');
    } else {
      $how_log_ago = $seconds . ' second' . ($seconds != 1 ? 's' : '');
    }
    return $how_log_ago;
}

// function to get today's task

function get_today_task(){

    $today = $this->today;
    $this->query="
    SELECT * FROM task WHERE  (date LIKE '$today%') AND assigned_to='$_SESSION[ID]'
    ";
    $this->execute();
    $row = $this->get_result();
    foreach($row as $res){
        return $res['task_title'];
    }
   
}
// function to get today's task duration

function get_today_task_duration(){

    $today = $this->today;
    $this->query="
    SELECT * FROM task WHERE  (date LIKE '$today%') AND assigned_to='$_SESSION[ID]'
    ";
    $this->execute();
    $row = $this->get_result();
    foreach($row as $res){
        return $res['duration'];
    }
   
}

    // function to get employee basic salary
    function get_employee_basic_salary($id){

        $today = $this->today;
        $this->query="
        SELECT * FROM `salary` WHERE empID='$id' 
        ";
        $this->execute();
        $row = $this->get_result();
        foreach($row as $res){
            return $res['basic'];
        }
       
    }
    // function to get employee hra
    function get_employee_hra($id){

        $today = $this->today;
        $this->query="
        SELECT * FROM `salary` WHERE empID='$id' 
        ";
        $this->execute();
        $row = $this->get_result();
        foreach($row as $res){
            return $res['hra'];
        }
       
    }
    // function to get employee hra
    function get_employee_loan($id){

        $today = $this->today;
        $this->query="
        SELECT * FROM salary WHERE empID='$id' 
        ";
        $this->execute();
        $row = $this->get_result();
        foreach($row as $res){
            return $res['loan'];
        }
       
    }


            //    function to get number of times present ths month
          function get_present_times($id){
            

            $month = date('m');
            $this->query="
            SELECT * FROM attendance WHERE month='$month' AND emp_id='$id'
            ";
               $this->execute();
               $count = $this->row_count();


            return $count;
          }
function get_deduction_amount($id){
    $this->query="
    SELECT * FROM deduction_list WHERE id='$id'
    ";
    $this->execute();
    $res = $this->get_result();
    foreach($res as $row){
        return $row['amount'];
    }
    
}

function get_deduction_type($id){
    $this->query="
    SELECT * FROM deduction_list WHERE id='$id'
    ";
    $this->execute();
    $res = $this->get_result();
    foreach($res as $row){
        return $row['deduction_name'];
    }
    
}


function get_staff_deduction($id){
    $month = date('m');

$this->query="
SELECT SUM(amount) AS total_amount FROM deductions WHERE emp_id='$id' AND month='$month'
";
$this->execute();
$res = $this->get_result();
foreach($res as $row){
    return $row['total_amount'];
}

}



}

?>