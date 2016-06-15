<!DOCTYPE html>

<?php


session_start();

//if(!$logged_in){ header('Location: http://127.0.0.1/fullcalendar-2.6.1/demos/login.php'); exit; }


if(!isset($_SESSION["user_name"]) && $_SESSION["user_name"] != "test" ){
header("Location: login.php");
exit;
}
?>

<html>
<head>
<meta charset='utf-8' />
<link rel='stylesheet' href='../lib/cupertino/jquery-ui.min.css' />
<link href='../fullcalendar.css' rel='stylesheet' />
<link href='../fullcalendar.print.css' rel='stylesheet' media='print' />

<script src='../lib/moment.min.js'></script>
<script src='../lib/jquery.min.js'></script>
<script src='../fullcalendar.min.js'></script>
<script src='../lang-all.js'></script>


<script>

	$(document).ready(function() {

        var d = new Date();
        var defaultDatestr = d.getFullYear() +"-"+ (d.getMonth()+1) +"-"+ d.getDate();
//        alert(defaultDatestr);


    var req_info="abc";
    $.ajax( {
        url:"calendar_response.php",
        method: "POST",
        dataType:"text",
        data: {"req_info":req_info}
    } )
    .done(function(msg){
        alert(msg);

    })
    .fail(function(){
        alert("fail");
    })
    .always(function(){

        alert("complete");

    })
    ;

        var data2 = new Object();
        data2['events'] = new Array();
        data2['events'][0] = new Object();
        data2['events'][0]['title'] = 'abc1234';
        data2['events'][0]['start'] = '2016-01-12';
        data2['events'][0]['end'] = '2016-01-15';

 //       alert(data);



        //$('#calendar').fullCalendar('renderEvent', data2, true);
	//	$('#calendar').fullCalendar(data);

       
		$('#calendar').fullCalendar({
			theme: true,
			header: {
				left: 'prev,next today,myCustomButton',
				center: 'title',
				right: 'year,month,agendaWeek,agendaDay'
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events


            dayClick: function(date,allDay, jsEvent, view) { 
                if (allDay) {

                    $('#calendar').fullCalendar('changeView', 'agendaDay');
                    $('#calendar').fullCalendar('gotoDate', date);

                }
                
            },

            lang: 'zh-tw',
            customButtons: {
                myCustomButton: {
                text: '+',
                click: function() {
                    alert('clicked the custom button!');
                }

                }
            },

            eventClick: function(event){
                $("<div>").dialog({ modal: true, title: event.title, width:350});
            },

		});

        $('#calendar').fullCalendar('addEventSource', data2, true);

        $('.fc-prev-button').click(function(){
           alert('prev is clicked, do something');
        });

        $('.fc-next-button').click(function(){
           alert('nextis clicked, do something');
        });

        $(".fc-today-button").click(function () {
        
            alert("today is click!");
        });

        $('.fc-month-button').click(function(){
           alert('month clicked, do something');
        });

        $('.fc-agendaWeek-button').click(function(){
           alert('week clicked, do something');
        });

        $('.fc-agendaDay-button').click(function(){
           alert('day clicked, do something');
        });

		
	});

</script>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

</style>
</head>
<body>
	<div id='calendar'></div>

</body>
</html>
