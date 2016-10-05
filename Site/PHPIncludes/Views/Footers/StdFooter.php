<footer>

</footer>


</body>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

      <?php
       if(isset($pageRequirements)){
         $jsFiles = $pageRequirements->getFiles("js");
       }

      if(isset($jsFiles)){
         foreach ($jsFiles as $fileName) {
            echo '<script async src="/' . $fileName . '"></script>';
         }
      }
      ?>
      </html>