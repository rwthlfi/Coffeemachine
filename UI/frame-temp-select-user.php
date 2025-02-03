 <head>
   <?php
    include('connection.php');
    ?>
   <meta charset="utf-8" />
   <link rel="icon" href="/favicon.ico" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <meta name="theme-color" content="#000000" />
   <title>Benutzer Auswählen</title>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A400" />
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400" />
   <link rel="stylesheet" href="./styles/frame-temp-select-user.css" />
 </head>

 <body>
   <div class="frame-temp-select-user">
     <div class="page-temp">
       <img class="logo-temp" src="./assets/Logo.png" />
       <div class="pop-window-temp">
         <div class="pop-window-temp-content">
           <p>Benutzer auswählen:</p>
           <ul class="list">
             <li id="user1">user 1</li>
             <li id="user2">user 2</li>
           </ul>
         </div>
       </div>

     </div>
     <script>
       var listItems = document.querySelectorAll('.list li');
       listItems.forEach(function(item) {
         item.addEventListener('click', function() {
           alert('You clicked: ' + item.textContent);
         });
       });
     </script>
   </div>
 </body><