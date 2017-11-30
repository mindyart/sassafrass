
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <img src = "logo.jpg" width = 100% height = 40%/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
    // Get items from local storage for placing in the DB
      var email = localStorage.getItem("Email");
      var id_token = localStorage.getItem("id_token");
    </script>

  </head>
  <body>

    <div class="container" padding = "">
    <h1 style="padding-top: 10px" >Events</h1>
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
            <div id="1" class="progress-wrap-sv progress-sv" data-progress-percent=' . $percentage . '>
              <div id="1a" class="progress-bar-sv progress-sv"></div>
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
            <td>Lonely Hearts Paint Night. This event will be held on February 14th, 2018</td>
            <td>2018-02-07 12:00:00</td>
            <td><div id="2a" class="progress-wrap-sv progress-sv" data-progress-percent="70">
              <div id="2" class="progress-bar-sv progress-sv"></div>
            </div></td>
            <td><button type="button" class="btn btn-success">Going</button></td>
          </tr>
          <tr>
            <td>Spicy Salsa Night. This event will be held on May 5th, 2018</td>
            <td>2018-04-20 12:00:00</td>
            <td><div id="3a" class="progress-wrap-sv progress-sv" data-progress-percent=40>
              <div id="3" class="progress-bar-sv progress-sv"></div>
            </div></td>
            <td><button type="button" class="btn btn-success">Going</button></td>
          </tr>
          <tr>
            <td>Kylie Jenner's Live Birth Viewing Party. This event will be held on August 20th, 2018</td>
            <td>2018-08-19 12:00:00</td>
            <td><div id="4a" class="progress-wrap-sv progress-sv" data-progress-percent=10>
              <div id="4" class="progress-bar-sv progress-sv"></div>
            </div></td>
            <td><button type="button" class="btn btn-success">Going</button></td>
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
      var getPercent1 = ($('.progress-wrap-sv').data('progress-percent') / 100);
      var getProgressWrapWidth1 = $('.progress-wrap-sv').width();
      var progressTotal1 = getPercent1 * getProgressWrapWidth1;
      var animationLength = 2500;

      // on page load, animate percentage bar to data percentage length
      // .stop() used to prevent animation queueing
      $('#1').stop().animate({
          left: progressTotal1
      }, animationLength);

      var getPercent2 = ($('#2a').data('progress-percent') / 100);
      var getProgressWrapWidth2 = $('#2').width();
      var progressTotal2 = getPercent2 * getProgressWrapWidth2;
      var animationLength = 2500;

      // on page load, animate percentage bar to data percentage length
      // .stop() used to prevent animation queueing
      $('#2').stop().animate({
          left: progressTotal2
      }, animationLength);

      var getPercent3 = ($('#3a').data('progress-percent') / 100);
      var getProgressWrapWidth3 = $('#3').width();
      var progressTotal3 = getPercent3 * getProgressWrapWidth3;
      var animationLength = 2500;

      // on page load, animate percentage bar to data percentage length
      // .stop() used to prevent animation queueing
      $('#3').stop().animate({
          left: progressTotal3
      }, animationLength);

      var getPercent4 = ($('#4a').data('progress-percent') / 100);
      var getProgressWrapWidth4 = $('#4').width();
      var progressTotal4 = getPercent4 * getProgressWrapWidth4;
      var animationLength = 2500;

      // on page load, animate percentage bar to data percentage length
      // .stop() used to prevent animation queueing
      $('#4').stop().animate({
          left: progressTotal4
      }, animationLength);
  }
      </script>
  </body>
  </html>
