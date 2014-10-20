<?php
/**
 * Description of myCalendar
 *
 */
class Calendar extends CI_Controller {
    
    public function index ($year = null, $month = null)
    {
        $this->display($year, $month);
    }
    
    public function display($year = null, $month = null)
    {
        if (!$year) {
            $year = date('Y');
	}
        if (!$month) {
            $month = date('m');
	}
        $this->load->model('Calendar_model');
        
        $day = $this->input->post('day');
        $postData = $this->input->post('data');
               
        if ($day && $postData) {
            $this->Calendar_model->add_calendar_data(
		"$year-$month-$day",
		$postData
            );
	}
        $data = array();
        $this->calendar->initialize($this->conf);	
	$data['calendar'] = $this->Calendar_model->generate($year, $month);
        $this->calendar->initialize($this->conf2);
	$data['mini_calendar'] = $this->Calendar_model->generate($year, $month);
        $this->load->view('calendar', $data);
    }
    
    var $conf;
    var $conf2;
    
    public function __construct() 
    {
        parent::__construct();
        
        $this->load->model('Calendar_model');
        
        $this->conf = array(
                'start_day'=>'monday',
                'show_next_prev' => TRUE,
                'next_prev_url' => base_url() . 'calendar/index',
                'month_type'   => 'long',
                'day_type'     => 'long'
            );
        
        $this->conf['template'] = '

            {table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

            {heading_row_start}<tr>{/heading_row_start}

            {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
            {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
            {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

            {heading_row_end}</tr>{/heading_row_end}

            {week_row_start}<tr>{/week_row_start}
            {week_day_cell}<td>{week_day}</td>{/week_day_cell}
            {week_row_end}</tr>{/week_row_end}

            {cal_row_start}<tr class="days">{/cal_row_start}
            {cal_cell_start}<td class="day">{/cal_cell_start}

            {cal_cell_content}
                <div class="day_num">{day}</div>
                <div class="content">{content}</div>
            {/cal_cell_content}
            
            {cal_cell_content_today}
                <div class="day_num highlight">{day}</div>
                <div class="content">{content}</div>
            {/cal_cell_content_today}

            {cal_cell_no_content}
                <div class="day_num">{day}</div>
            {/cal_cell_no_content}
            
            {cal_cell_no_content_today}
                <div class="day_num highlight">{day}</div>
            {/cal_cell_no_content_today}

            {cal_cell_blank}&nbsp;{/cal_cell_blank}

            {cal_cell_end}</td>{/cal_cell_end}
            {cal_row_end}</tr>{/cal_row_end}

            {table_close}</table>{/table_close}
         ';
        
        $this->conf2 = array(
			'start_day' => 'monday',
			'show_next_prev' => true,
			'next_prev_url' => base_url() . 'calendar/index',
                        'day_type'     => 'short'
		);
        
        $this->conf2['template'] = '
            
            {table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar" >{/table_open}
            

            {heading_row_start}{/heading_row_start}

            {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
            {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
            {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

            {heading_row_end}</tr>{/heading_row_end}

            {week_row_start}<tr>{/week_row_start}
            {week_day_cell}<td class="left">{week_day}</td>{/week_day_cell}
            {week_row_end}</tr>{/week_row_end}

            {cal_row_start}<tr class="days">{/cal_row_start}
            {cal_cell_start}<td class="day">{/cal_cell_start}

            {cal_cell_content}
                <div class="day_num">{day}</div>
                <div class="content">{content}</div>
            {/cal_cell_content}
            
            {cal_cell_content_today}
                <div class="day_num highlight">{day}</div>
                <div class="content">{content}</div>
            {/cal_cell_content_today}

            {cal_cell_no_content}
                <div class="day_num">{day}</div>
            {/cal_cell_no_content}
            
            {cal_cell_no_content_today}
                <div class="day_num highlight">{day}</div>
            {/cal_cell_no_content_today}

            {cal_cell_blank}&nbsp;{/cal_cell_blank}

            {cal_cell_end}</td>{/cal_cell_end}
            {cal_row_end}</tr>{/cal_row_end}

            {table_close}</table>{/table_close}
            
        ';
        $this->load->library('calendar');
    }
    
}
