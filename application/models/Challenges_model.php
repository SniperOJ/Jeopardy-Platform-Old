<?php
class Challenges_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    /* get functions */

    public function get_challenge_name($challengeID)
    {
        $query = $this->db->get_where('challenges', array('challengeID' => $challengeID));
        $result = $query->row_array();
        return $result['name'];
    }

    public function get_description($challengeID)
    {
        $query = $this->db->get_where('challenges', array('challengeID' => $challengeID));
        $result = $query->row_array();
        return $result['description'];
    }

    public function get_flag($challengeID)
    {
        $query = $this->db->get_where('challenges', array('challengeID' => $challengeID));
        $result = $query->row_array();
        return $result['flag'];
    }

    public function get_score($challengeID)
    {
        $query = $this->db->get_where('challenges', array('challengeID' => $challengeID));
        $result = $query->row_array();
        return $result['score'];
    }

    public function get_type($challengeID)
    {
        $query = $this->db->get_where('challenges', array('challengeID' => $challengeID));
        $result = $query->row_array();
        return $result['type'];
    }

    public function get_online_time($challengeID)
    {
        $query = $this->db->get_where('challenges', array('challengeID' => $challengeID));
        $result = $query->row_array();
        return intval($result['online_time']);
    }

    public function get_visit_times($challengeID)
    {
        $query = $this->db->get_where('challenges', array('challengeID' => $challengeID));
        $result = $query->row_array();
        return $result['visit_times'];
    }

    public function get_fixing($challengeID)
    {
        $query = $this->db->get_where('challenges', array('challengeID' => $challengeID));
        $result = $query->row_array();
        return $result['fixing'];
    }

    public function get_resource($challengeID)
    {
        $query = $this->db->get_where('challenges', array('challengeID' => $challengeID));
        $result = $query->row_array();
        return $result['resource'];
    }

    public function get_document($challengeID)
    {
        $query = $this->db->get_where('challenges', array('challengeID' => $challengeID));
        $result = $query->row_array();
        return $result['document'];
    }


    /* set functions */

    public function set_name($challengeID, $name)
    {
        $this->db->set(array('name' => $name));
        $this->db->where('challengeID', $challengeID);
        $this->db->update('challenges');
    }

    public function set_description($challengeID, $description)
    {
        $this->db->set(array('description' => $description));
        $this->db->where('challengeID', $challengeID);
        $this->db->update('challenges');
    }

    public function set_flag($challengeID, $flag)
    {
        $this->db->set(array('flag' => $flag));
        $this->db->where('challengeID', $challengeID);
        $this->db->update('challenges');
    }

    public function set_score($challengeID, $score)
    {
        $this->db->set(array('score' => $score));
        $this->db->where('challengeID', $challengeID);
        $this->db->update('challenges');
    }

    public function set_visit_times($challengeID, $visit_times)
    {
        $this->db->set(array('visit_times' => $visit_times));
        $this->db->where('challengeID', $challengeID);
        $this->db->update('challenges');
    }

    public function set_type($challengeID, $type)
    {
        $this->db->set(array('type' => $type));
        $this->db->where('challengeID', $challengeID);
        $this->db->update('challenges');
    }

    public function set_online_time($challengeID, $online_time)
    {
        $this->db->set(array('online_time' => $online_time));
        $this->db->where('challengeID', $challengeID);
        $this->db->update('challenges');
    }

    public function set_fixing($challengeID, $fixing)
    {
        $this->db->set(array('fixing' => $fixing));
        $this->db->where('challengeID', $challengeID);
        $this->db->update('challenges');
    }

    public function set_resource($challengeID, $resource)
    {
        $this->db->set(array('resource' => $resource));
        $this->db->where('challengeID', $challengeID);
        $this->db->update('challenges');
    }

    public function set_document($challengeID, $document)
    {
        $this->db->set(array('document' => $document));
        $this->db->where('challengeID', $challengeID);
        $this->db->update('challenges');
    }

    /* advance function */
    public function get_all_challenges($userID)
    {
        $query = $this->db
            ->where(array("fixing" => "0"))
            ->get("challenges");
        $challenges = $query->result_array();
        for ($i=0; $i < count($challenges); $i++) { 
            $challenges[$i]['solved_times'] = $this->challenges_model->get_challenge_solved_times($challenges[$i]['challengeID']);
            $challenges[$i]['submit_times'] = $this->challenges_model->get_challenge_submit_times($challenges[$i]['challengeID']);
            $challenges[$i]['is_solved'] = $this->challenges_model->is_solved_by_userID($challenges[$i]['challengeID'], $userID);
        }
        return $challenges;
    }

    public function is_solved_by_userID($challengeID, $userID)
    {
        $query = $this->db->select('submit_time')
        ->where(array(
            "challengeID" => $challengeID,
            "userID" => $userID,
            "is_current" => "1"
        ))
        ->get('submit_log');
        $result = $query->num_rows();
        return $result;
    }

    public function get_challenge_solved_times($challengeID){
        $query = $this->db->select('submitID')
        ->where(array(
            "is_current" => "1",
            "challengeID" => $challengeID,
        ))
        ->get('submit_log');
        $result = $query->num_rows();
        return $result;
    }

    public function get_challenge_submit_times($challengeID){
        $query = $this->db->select('submitID')
        ->where(array(
            "challengeID" => $challengeID,
        ))
        ->get('submit_log');
        $result = $query->num_rows();
        return $result;
    }

    public function get_type_challenges($userID, $type)
    {
        $query = $this->db
            ->where(array(
                "fixing" => "0",
                "type" => $type,
            ))
            ->get("challenges");
        $challenges = $query->result_array();
        for ($i=0; $i < count($challenges); $i++) { 
            $challenges[$i]['solved_times'] = $this->challenges_model->get_challenge_solved_times($challenges[$i]['challengeID']);
            $challenges[$i]['submit_times'] = $this->challenges_model->get_challenge_submit_times($challenges[$i]['challengeID']);
            $challenges[$i]['is_solved'] = $this->challenges_model->is_solved_by_userID($challenges[$i]['challengeID'], $userID);
        }
        return $challenges;
    }

    public function get_challenges_number($type)
    {
        $query = $this->db->select('challengeID')
        ->where(array(
            "type" => $type,
        ))
        ->get('challenges');
        $result = $query->num_rows();
        return $result;
    }

    public function update_visit_times($challengeID)
    {
        $visit_times = intval($this->get_visit_times($challengeID));
        $this->set_visit_times($challengeID, $visit_times+1);
    }

    function formatTime($time){       
        $rtime = date("Y年m月d日 H:i",$time);       
        $htime = date("H:i",$time);             
        $time = time() - $time;         
        if ($time < 60){           
            $str = '刚刚';       
        }elseif($time < 60 * 60){           
            $min = floor($time/60);           
            $str = $min.'分钟前';       
        }elseif($time < 60 * 60 * 24){           
            $h = floor($time/(60*60));           
            $str = $h.'小时前 ';       
        }elseif($time < 60 * 60 * 24 * 3){           
            $d = floor($time/(60*60*24));           
            if($d==1){  
                $str = '昨天 '.$htime;
            }else{  
                $str = '前天 '.$htime;       
            }  
        }else{           
            $str = $rtime;       
        }       
        return $str;
    }

    public function get_progress($offset_time){
        $query = $this->db->select(array('challengeID', 'userID', 'submit_time'))
        ->where(array(
            // 'is_current' => '1',
            'submit_time > ' => time() - $offset_time,
        ))
        ->get('submit_log');
        $result = $query->result_array();

        for ($i=0; $i < count($result); $i++) { 
            $result[$i]['submit_time'] = $this->formatTime($result[$i]['submit_time']);

            $userID = $result[$i]['userID'];
            $challengeID = $result[$i]['challengeID'];

            $username = $this->user_model->get_username($userID);
            $challenge_name = $this->get_challenge_name($challengeID);

            $result[$i]['username'] = $username;
            $result[$i]['challenge_name'] = $challenge_name;
        }
        return $result;
    }
}
