<?php
/**
 * Description of MyCalendarModel
 *
 */
class Calendar_model extends CI_Model {
    
    public function get_calendar_data($year, $month) 
    {
		
	$query = $this->db->select('date, data')->from('calendar')
            ->like('date', "$year-$month", 'after')->get();
			
	$cal_data = array();
		
	foreach ($query->result() as $row) {
            $cal_data[intval(substr($row->date,8,2))] = $row->data;
	}
		
	return $cal_data;
		
    }
	
    public function add_calendar_data($date, $data) 
    {
        
	if ($this->db->select('date')->from('calendar')
		->where('date', $date)->count_all_results()) {
			
            $this->db->where('date', $date)
		->update('calendar', array(
		'date' => $date,
		'data' => $data			
		));
			
	} else {
		
            $this->db->insert('calendar', array(
                'date' => $date,
                'data' => $data			
            ));
        }
	
        
    }
    
    public function generate($year, $month)
    {
        
        $cal_data = $this->get_calendar_data($year, $month);
		
	return $this->calendar->generate($year, $month, $cal_data);
        
    }
    
}
