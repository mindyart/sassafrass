
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheets/styles.css?v=<?=time();?>">
    <img src = "assets/logo.jpg" width = 100% height = 40%/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src=" http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    <script>
    // Get items from local storage for placing in the DB -- figure out how to php <-> js
      var email = localStorage.getItem("Email");
      var id_token = localStorage.getItem("id_token");
    </script>
  </head>

  <body>
    <h1>What's going on? 📅</h1>
    <div class="container-fluid">
      <div class="card-deck">
            <?php
            include "dbconnection.php";

            $con = getdb();
            $sql = "SELECT e.EventID, e.Title, e.eventDate, e.Deadline, e.Going, e.Threshold FROM Events e order by 3 asc;";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {

               while($row = mysqli_fetch_assoc($result)) {
                 $eventID = $row['EventID'];
                 $going = $row['Going'];
                 $threshold = $row['Threshold'];
                 $percentage = (($going / $threshold) * 100);
                 $eventDate = date_create($row['eventDate']);
                 $deadline = date_create($row['Deadline']);
                 $interval = date_diff($deadline, $eventDate);

                 echo '
                  <div class="card">
                    <div class="cardheader">
                      <h2><a id="title" href="https://emojikeyboard.org/"> ' . $row['Title'] . ' </a></h2>
                    </div>

                    <div class="card-body info">
                      <i>Event date</i>: ' . date_format($eventDate, 'l\, F jS\, Y \@ <b>g:ia</b>') . '<br><br>

                      <p class="alert">' . $interval->format('%a days and %h hours to go!') . '<p>

                      <div class="wrap">
                        <div class="barz-percentage" data-percentage="' . $percentage . '"></div>
                        <div class="barz-container">
                          <div class="barz"></div>
                        </div>
                      </div>

                      <span class="tiltLeft"><b>' . $going . '</b> people going </span>
                      <span class="tiltRight">Tilts at ' . $threshold . '</span>

                      <div class="buttonz">
                        <form action= "attend.php" method= "post">
                          <input type="hidden" name="eventID" value="' . $eventID . '"/>
                          <input type="hidden" name="eventID" value="' . $eventID . '"/>
                        <button type="button" class="btn btn-lg">Going 🙋</button>
                      </div>
                    </div>
                  </div>
                 ';
               }
            }
            else
            {
               echo "you have no records";
            }
            ?>
          </div>
        </div>

<!-- progress bar script -->
      <script>
      $('.barz-percentage[data-percentage]').each(function () {
        var progress = $(this);
        var percentage = Math.ceil($(this).attr('data-percentage'));
        $({countNum: 0}).animate({countNum: percentage}, {
          duration: 2000,
          easing:'linear',
          step: function() {
            // What todo on every count
          var pct = '';
          if(percentage == 0){
            pct = Math.floor(this.countNum) + '%';
          }
          if(percentage > 100){
            pct = 100 + '%';
          }
          else{
            pct = Math.floor(this.countNum+1) + '%';
          }
          progress.siblings().children().css('width',pct);
          }
        });
      });
      </script>
    </body>
  </html>
