<html>
    <head>
        <style>
         .cur{
             background-color: green;
             color: white;
         }
        </style>
    </head>
    
    <body>
        
        <div id="data">
            
        </div>
		<script>
           
            var obj=JSON.parse('<?php echo json_encode($studentlist);?>');
            var rows = "<table class='cur' border='1'><tr><th>SL</th><th>Name</th><th>Id</th></tr>";
            for(var i=0; i<obj.length; i++){
                rows+="<tr><td>"+i+"</td><td>"+obj[i].firstName+"</td><td>"+obj[i].studentId+"</td></tr>";
            }
            rows+="</table>";
            document.getElementById("data").innerHTML = rows;
            //alert(obto);
        </script>
          </body>
</html>