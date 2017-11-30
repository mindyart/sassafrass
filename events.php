
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
    // Get items from local storage for placing in the DB
      var email = localStorage.getItem("Email");
      var id_token = localStorage.getItem("id_token");
    </script>

  </head>
  <body>
    <h1>Events</h1>
    <div class="container">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Event Details</th>
            <th>Deadline</th>
            <th>Progress</th>
            <th>Interested?</th>
          </tr>
        </thead>
        <tbody>
          <!-- real example -->
          <tr>
            <!-- 1st column -->
            <td>Secret Santa. This event will be held on December 4th, 2017. <br></td>

            <!-- 2nd column -->
            <?php
            include "dbconnection.php";

            $con = getdb();
            $sql = "SELECT e.Deadline
                , e.Going
                ,e.Threshold
                FROM Events e
                WHERE e.EventID = 1;";

            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {

               while($row = mysqli_fetch_assoc($result)) {

                 echo "<td>" . $row['Deadline']."</td>";
                 $going = $row['Going'];
                 $threshold = $row['Threshold'];
                 $percentage = ($going / $threshold * 100);
               }
            } else
            {

               echo "you have no records";

            }

            echo '<td>
            <div class="progress-wrap-sv progress-sv" data-progress-percent="' . $percentage . '">
              <div class="progress-bar-sv progress-sv"></div>
            </div>
            </td>'
            ?>

<!-- get michelle's google authentication variable and add to database + increment going by 1 -->
           <td>
		  <button type="button" class="btn btn-success">Going</button>
		  <!--- <form method="post" action="mailto:piamedina@hotmail.com.com" > --->
			<!---<input type="submit" class="btn btn-default" value="Going" /> --->
			</form>
		   </td>
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

      <script>
      // on page load...
  moveProgressBar();
  // on browser resize...
  $(window).resize(function() {
      moveProgressBar();
  });

  // SIGNATURE PROGRESS
  function moveProgressBar() {
    console.log("moveProgressBar");
      var getPercent = ($('.progress-wrap-sv').data('progress-percent') / 100);
      var getProgressWrapWidth = $('.progress-wrap-sv').width();
      var progressTotal = getPercent * getProgressWrapWidth;
      var animationLength = 2500;

      // on page load, animate percentage bar to data percentage length
      // .stop() used to prevent animation queueing
      $('.progress-bar-sv').stop().animate({
          left: progressTotal
      }, animationLength);
  }
      </script>
  </body>
  </html>
