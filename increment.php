<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Div Click Event</title>
</head>
<body>

<?php
// PHP code to generate div elements with unique IDs
for ($i = 1; $i <= 5; $i++) {
?>
    <div id='up<?php echo $i;?>' class='clickable'>up<?php echo $i;?></div>
    <div id='down<?php echo $i;?>' class='clickable'>down<?php echo $i;?></div>

<?php
}
?>
<script>
  // JavaScript code to attach click event listener to each div
  document.addEventListener('DOMContentLoaded', function() {
    // Get all div elements with class 'clickable'
    var divs = document.querySelectorAll('.clickable');

    // Attach click event listener to each div
    divs.forEach(function(div) {
        div.addEventListener('click', function() {
            console.log('Div clicked:', this.id);
        });
    });
});
</script>

</body>
</html>
