<?php
    

    $weather = "";
    $error = "";
    
    # start with checking 
        if ($_GET['city']) {

      # then I connect the API link

          $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urldecode($_GET['city']).",&appid=d");
    
      # Converting json in PHP
        $weatherArray = json_decode($urlContents, true);

    
        if ($weatherArray['cod'] == 200) { 
        // SELECTING from API Doc's page and view source page to select elements.
        $weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'.";

        $tempInCelcius = intval($weatherArray['main']['temp'] - 273.15); #converting to Kelvin to Celcius

        $weather .= " <br>The temperature is ".$tempInCelcius."&deg;C.";

        $humidity = $weatherArray['main']['humidity'];
        
        $weather .= "<br> Humidity ".$humidity.".";

        $windSpeed = intval($weatherArray['wind']['speed'] * 2.23694);

        $weather .= "<br> Wind speed ".$windSpeed."mph.";

      

       } else {
         $error = "Could not find city - please try again.";


       }

   } 
    

?>  

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>The Wearther Now</title>

  
  </head>
  <body>
    <div class="container">

    <h2>The Wearther Now In Your City</h2>
    

    <form>
  <div class="form-group">
    <label for="city"><p>Enter the name of a city.</p></label>
    <input type="text" name="city" class="form-control" id="city" placeholder="Eg. NewYork, Tokyo" value="<?php 
    
    if (array_key_exists('city', $_GET)) {
    
     echo $_GET['city']; 
                                                                                                     
    }                                                                                       
                                                                                                                                                             
          ?>">
    <small class="form-text text-muted"></small>
  </div>
 <br> 
  
 <button id="buttonColor" type="submit" class="btn btn-primary">Search</button>
    
       
</form>
<br>
 <div id="weather"><?php

        if ($weather) {
            echo '<div class="alert alert-success" role="alert">' .$weather.'</div>' ;

        } else if ($error) {
          echo '<div class="alert alert-danger" role="alert">' .$error.'</div>' ;

      }

    
                          
     ?></div>
<br> <br> <br>
    </div>


      





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
  
  </body>
</html>
