<!DOCTYPE html>
<html lang="em">
<head>
    <meta charset="utf-8">
    <title>Proposed Schedule - MESS</title>
    <link rel="stylesheet" href="CSS/Proposed_Schedule.css"/>
    <script src="../JavaScript/MESS_algorithm.js"></script>
    <script src="../Data/data.js"></script>
</head>
<body>
<?php
        include "session.php";
        $sql = "SELECT * FROM sas";
        $result = $link->query($sql) or die('error connecting');
       
       
       $nameArray =array();
       $greenArray=array();
       $yellowArray=array();
       $minhourArray=array();
       $maxhourArray=array();
       $vetArray=array();
       $workingArray=array();
       
       
        if (sizeof($result) > 0) {
            // output data of each row
            
            while($row = $result->fetch_assoc()){
                $nameArray[] = $row['fname'];
                $greenArray[] = $row['greenAvail'];
                $yellowArray[] = $row['yellowAvail'];
                $minhourArray[] = $row['minHr'];
                $maxhourArray[] =$row['maxHr'];
                $vetArray[] =$row['vetStatus'];
                $workingArray[]=$row["workingHours"];
            }
        }
        else{
        echo "0 results";
       
    }
        mysqli_close($link);
        ?>
<script>
var nameArray = <?php echo '["' . implode('", "', $nameArray) . '"]' ?>;
var greenArray = <?php echo '["' . implode('", "', $greenArray) . '"]' ?>;
var yellowArray = <?php echo '["' . implode('", "', $yellowArray) . '"]' ?>;
var minhourArray = <?php echo '["' . implode('", "', $minhourArray) . '"]' ?>;
var maxhourArray = <?php echo '["' . implode('", "', $maxhourArray) . '"]' ?>;
var vetArray = <?php echo '["' . implode('", "', $vetArray) . '"]' ?>;
var workingArray = <?php echo '["' . implode('", "', $workingArray) . '"]' ?>;
for(i =0; i<nameArray.length;i++){
    listofSa[i]=new SA ( nameArray[i],greenArray[i],yellowArray[i],minhourArray[i],maxhourArray[i],vetArray[i],workingArray[i]);
}
</script>





    <script>//this is for the color changing. DO NOT MESS WITH THIS
    function changePage(){
    var boxlist=document.getElementsByClassName("box");
    for(i=0;i<boxlist.length;i++){
        boxlist[i].onclick=function(e){
            if(e.target.classList.contains("red")){               
                e.target.classList.replace("red","green");
               e.target.style.color= "green";
               e.target.style.backgroundColor = "green";           
            }
            else if(e.target.classList.contains("yellow")){
                e.target.classList.replace("yellow","red");
                e.target.style.color= "red";
                e.target.style.backgroundColor = "red";           
            }
            else if(e.target.classList.contains("green")){
                e.target.classList.replace("green","yellow");
                e.target.style.color = "yellow";
                e.target.style.backgroundColor = "yellow";           
            }
        }
    }
    }
   
    algorithm(listofSa, listOfHours);
</script>
    <div class="sidebar">
        <img class="logo" src="images/MESS Logo.jpg">
        <a href="MESS_finalized.html">Semester Schedule</a><br>
        <a href="MESS_master.php">Master Schedule</a><br>
        <a href="MESS_assistants.php">Student Assistants</a><br>
        <a href="MESS_courses.html">Start New Schedule</a><br>
        <a href="logout.php">Logout</a>
    </div>
    <h1>Proposed Schedule</h1>
    <h2>Term: Fall 2019</h2>
 <table >
     <tr>
         <th>Courses</th><th>times</th><th>Days</th>
         <script>
        listofSa.forEach(function(sa) {
            document.write("<th>"+sa.name+"</th>");
        });
        </script></tr>
        <script>
            for(i=0;i<listOfHours.length;i++){
                var day="";
                if (listOfHours[i].name.charAt(0)=="M"||listOfHours[i].name.charAt(0)=="W"||listOfHours[i].name.charAt(0)=="F"){
                    day="MWF";
                }
                else{
                    day="TR";
                }
                document.write("<tr><td></td><td>"+listOfHours[i].name.charAt(1)+listOfHours[i].name.charAt(2)+":"+listOfHours[i].name.charAt(3)+listOfHours[i].name.charAt(4)+"</td><td>"+day+"</td>");
            //alert(listofSa[0].name);
            listofSa.forEach(function(sa){
                if(sa.workingHours.includes(listOfHours[i].name)){
                //make green
                    document.write("<td class='green'>green</td>")
                }
                else if (listOfHours[i].sublist.includes(sa)){
                //make yellow
                document.write("<td class='yellow'>yellow</td>")
                }
                else{
                //make red
                document.write("<td class='red'>red</td>")
                }
            })
        }
        </script>
        
 </table>
      <Div id="buttons">
       <script>
        //
        </script>
                <button onclick="changePage()">Edit</button>
                    <button onclick="algorithm(listofSa, listOfHours)">should be Finalize, is not</button>
      </Div>
      <div>
        <image>
            <img src="Images/Copyright.jpg" alt="Copyright" class="footer" width:100%>
        </image>
    </div>
</body>

</html>