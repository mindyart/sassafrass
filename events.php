
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"
  </head>
  <body>
    <h1>Events</h1>
    <div class="container">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Event Details</th>
            <th>Progress</th>
            <th>Deadline</th>
            <th>Interested?</th>
          </tr>
        </thead>
        <tbody>
          <!-- real example -->
          <tr>
            <td>Secret Santa. This event will be held on December 4th, 2017. <br></td>
			<?php
			include "dbconnection.php";
			$con = getdb(); 
			$Sql = "SELECT e.Deadline
					, e.Going
					,e.Threshold
					FROM Events e
					WHERE e.EventID = 1;

//<!-- Progress - pull going/threshold from database-->
    
//<!-- pull deadline -->
            <td></td>
			
			<td></td>
			

			
			?>
<!-- get michelle's google authentication variable and add to database + increment going by 1 -->
            <td></td>
          </tr>
          <!-- hardcoded example -->
          <tr>
            <td>Paint Night</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
  </body>
  </html>
