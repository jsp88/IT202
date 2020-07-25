<?php
include("header.php");

?>
<html>
<body onload="SendToQuestion()">

<br>
<br>
<center style="color: black; font-family:Roboto; font-size:40px;">Take survey</center> 
<br> 
<br> 
<br> 
 <div id="selection">
    <form>
     <center> <table id="review"> </table> </center>
    </form>
  </div>
<br> 
</body> 

<script>
  var QuestionIDs = new Array();
var survey;
function SendToQuestion() {
  
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
		console.log(response);
        DisplayList(response);
      }
    };
    xhr.open("POST", "survey.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

  }

function DisplayList(response) {
    var l = Object.keys(response).length;
    var html = "";

    html += '<thead> <tr>';
      html += '<th style = "text-align: center">' + 'Available Surveys Are Listed Below ' + '</th>';
    html += '</tr> </thead>';
    html += '<tbody >';
    for (var i = 0; i < l; i++) {
       SurveyName = response[i]["titlename"];
      console.log(SurveyName);
	
	html += '<td>' + '<a href="#" style="color: blacks;" ' + 'onclick=GetQuestion("' + SurveyName + '") >' + SurveyName + ' </td>';
	html += '</tbody>';
    }
    document.getElementById("review").innerHTML = html;

  }


function GetQuestion(SurveyName){
    window.survey = SurveyName;
    document.getElementById("review").innerHTML = "";
    document.getElementById("selection").innerHTML = "";
    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        console.log(response);
	if(response['response'] == 'reject'){
	var html="<div class='submitted'>";
                 html+='<h4><center><font size="+2">This Survey was already Taken before </font></center></h4>';
                 var ajaxDisplay = document.getElementById('exam');
		document.getElementById("examheading").innerHTML = "";
                 ajaxDisplay.innerHTML=html;
	}
	else{
        DisplayQuestion(response);
	}
      }
    };
    xhr.open("POST", "questions.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
var sendd = {'titlename' : SurveyName };
console.log(sendd);    
xhr.send(JSON.stringify(sendd));
  }
  
  
function DisplayQuestion(response) {
    var count = 5;
    var exam = "";
//  var questionID = "";
	if(response['question4']=='-1')
		{ count--; }
	if(response['question5']=='-1')
		{ count--; }
	
		exam+= '<h1 style="float:center;color:black;">' + survey + "'s Survey </h1><br>";
	for (var index = 1; index <= count; index++) {
		
      var QuestionID = index;
      console.log(QuestionID);
      var quest = response['question'+index];
	  console.log(quest);
      
      window.QuestionIDs.push(QuestionID);
      exam += '<h3 style="float:center;">' + index + " " + quest+ '</h3>';
      exam += '<textarea rows="10" style="width:80%" placeholder="Fill your answer over here..." id=' + QuestionID + ' class="questions" >' + '</textarea>';
    }
    exam += '<br><br><button type="button" class="submitbutton" onclick="SendAns()">Submit</button>';
    document.getElementById("selection").innerHTML = exam;
	
}

 function SendAns() {
    var response = [];
	response.push({"titlename":survey });
    for (var index = 1; index <= window.QuestionIDs.length; index++) {
      	var qu_id = window.QuestionIDs[index-1];
		var data = {};
      	data['ID'] = qu_id;
      	data['answer_body'] = document.getElementById(qu_id).value;
	response.push(data);
	}
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            	 console.log(this.responseText);
	   	 var html="<div class='submitted'>";
	   	 html+='<h4><center><font size="+2">Exam Successfully Submitted</font></center></h4>';
   		 var ajaxDisplay = document.getElementById('review');
    		ajaxDisplay.innerHTML=html;
        }
      };
      xhr.open("POST", "Answers.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(JSON.stringify(response));
	  console.log(response);
  }

</script>

</html>






  
        
