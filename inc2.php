<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Toggle Div Click Event</title>
<style>
  .clickable {
    cursor: pointer;
    padding: 10px;
    border: 1px solid #ccc;
    margin: 5px;
  }
  .highlight {
    background-color: lightblue;
  }
</style>
</head>
<body>

<?php
// Define the number of sets and divs
$numSets = 3;
$numDivsPerSet = 2;

// Generate HTML for divs
for ($i = 1; $i <= $numSets; $i++) {
    echo "<div id='set_$i'>";
    for ($j = 1; $j <= $numDivsPerSet; $j++) {
        $divId = "div_" . $i . "_" . $j;
        echo "<div id='$divId' class='clickable' onclick='toggleDiv(this); callPHP($i, $j)'>Set $i - Div $j</div>";
    }
    echo "</div>";
}
?>

<script>
  // Function to toggle div
  function toggleDiv(clickedDiv) {
    // Check if the clicked div is already highlighted
    var isHighlighted = clickedDiv.classList.contains('highlight');

    // Get the parent div of the clicked div
    var parentDiv = clickedDiv.parentNode;

    // Get all clickable divs within the parent div
    var divs = parentDiv.querySelectorAll('.clickable');

    // Loop through all divs within the parent div
    divs.forEach(function(div) {
      // Toggle highlight class only for the clicked div
      if (div === clickedDiv) {
        if (isHighlighted) {
          // If already highlighted, remove highlight class
          div.classList.remove('highlight');
        } else {
          // If not highlighted, add highlight class
          div.classList.add('highlight');
        }
      } else {
        // Remove highlight class from other divs
        div.classList.remove('highlight');
      }
    });
  }

  // Function to call PHP file with set number and div number
  function callPHP(setNumber, divNumber) {
    var url = 'generate.php?set=' + setNumber + '&div=' + divNumber;

    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.text();
      })
      .then(data => {
        console.log('Response:', data);
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      });
  }
</script>

</body>
</html>
