
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheets/styles.css">
    <img src = "assets/logo.jpg" width = 100% height = 40%/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
    // Get items from local storage for placing in the DB
      var email = localStorage.getItem("Email");
      var id_token = localStorage.getItem("id_token");
    </script>

  </head>
  <body>
    <h1>What's going on? 📅</h1>
    <p class="desc"></p>
    <div class="container" padding = "">
      <div class="row">
        <div class="col">
          <h2><a id="title" href="https://emojikeyboard.org/">Secret Santa</a></h2>

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
                 $going = $row['Going'];
                 $threshold = $row['Threshold'];
                 $percentage = ($going / $threshold * 100);
                 echo 'Target date: December 4th, 2017. <br>
                 Deadline: ' . $row['Deadline'] .
                 '<h3>' . $going . ' going </h3>
                 <p class="tiltRight">Tilts at ' . $threshold . '</p>';
               }
            }
            else
            {
               echo "you have no records";
            }

            echo '<div id="1a" class="progress-wrap-sv progress-sv" data-progress-percent=' . $percentage . '>
                    <div id="1" class="progress-bar-sv progress-sv"></div>
                  </div>'
            ?>

		        <button type="button" class="btn btn-default btn-lg">Going 🙋</button>
          </div>
          <!-- hardcoded example -->
          <div class="col">
            <h2><a id="title" href="http://www.color-hex.com/color-names.html">Basketball Tourney</a></h2>
            Target date: February 14th, 2018 <br>
            Deadline: 2018-02-07 23:15:00
            <h3> 10 going </h3>
            <p class="tiltRight">Tilts at 20</p>
            <div id="2a" class="progress-wrap-sv progress-sv" data-progress-percent="50">
              <div id="2" class="progress-bar-sv progress-sv"></div>
            </div>
            <button type="button" class="btn btn-default btn-lg">Going 🙋</button>
          </div>
        </div>
      </div>

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
      var getPercent1 = ($('#1a').data('progress-percent') / 100);
      var getProgressWrapWidth1 = $('#1').width();
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
  }
      </script>
    </body>
  </html>
