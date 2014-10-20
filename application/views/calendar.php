<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <title>My Calendar</title>
        <meta charset="UTF-8">
        <style type="text/css">
            .calendar-type {
                font-family : Arial;
                font-size : 15px;
                margin-left: 450px;
                
            }
            
            #right table{
               font-family : Arial;
               font-size : 15px; 
            }
            
            #left .left {
                font-size: 12px;
            }
            
            div#left {
                float: left;
                margin-bottom: 10em;
                margin-top: 10em;
            
            }
            
            div#main {
                margin-left: 400px;
                width: 700px;
                
            }
            
            #left .calendar .days td {
               font-size:10px;
               width: 35px;
               height: 35px;
               
           }
            .calendar {
                font-family : Arial;
                font-size : 15px;
            }
            
            table.calendar {
                margin : auto;
                border-collapse: collapse;
            }
            
            .calendar .days td {
                width : 80px;
                height : 80px;
                padding : 4px;
                border : 1px solid #999;
                vertical-align : top;
                background-color : #DEF;
            }
            
            .calendar .days td:hover {
                background-color : #FFF;
            }
            
            .calendar .highlight {
                font-weight : bold;
                color : #00F;
            }
            
            .calendar-type li {display: inline-block;}
        </style>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>    
    <body>
        <div>
            <div id="left">
                <?php echo $mini_calendar; ?>
            </div>

            <div id="main">
                <div>
                    <ul class="calendar-type">
                        <li>Day</li>
                        <li>Week</li>
                        <li>Month</li>
                        <li>Agenda</li>
                    </ul>
                </div>
               <?php echo $calendar; ?>
            </div>
        </div>
        <script type="text/javascript">
	$(document).ready(function() {
            $('.calendar .day').click(function() {
		day_num = $(this).find('.day_num').html();
		day_data = prompt('Introduceti date', $(this).find('.content').html());
                if (day_data != null) {
				
                    $.ajax({
			url: window.location,
			type: 'POST',
			data: {
                            day: day_num,
                            data: day_data
                            },
                            success: function(msg) {
				location.reload();
					}						
                    });
				
		}
			
            });
		
	});
		
	</script>

    </body>
</html>


