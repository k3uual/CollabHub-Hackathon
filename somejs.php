<html>
    <head>
        <title>Some JS</title>
    </head>
    <style>
        <?php
            $count = 0;
            while($count<5){
        ?>
        #up, #down<?php $count;?> {
            width: 100px;
            height: 100px;
        }
        #up.unfill, #down.unfill {
            background-color: red;
        }
        #up.fill, #down.fill {
            background-color: green;
        }
        <?php
            $count++;
            }
        ?>
    </style>
    <body>
        <div id="vote">
            <?php
            $count = 0;
            while($count<5){
            ?>
            <div id="up<?php $count;?>" class="unfill">upvote</div>
            <div id="down<?php $count;?>" class="unfill">downvote</div>
            <?php
            $count++;
            }
            ?>
        </div>
        <div>
            <div id="upcount"><?php echo 0?></div>
            <div id="downcount"><?php echo 0?></div>
        </div>
        
    </body>
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            <?php
            $count = 0;
            while($count<5){
            ?>
            let up = document.getElementById("up<?php $count;?>");
            let down = document.getElementById("down<?php $count;?>");
            let call = "operate.php";
            // Add event listeners to the buttons
            let dcount = document.getElementById("downcount");
            let ucount = document.getElementById("upcount");
            // Get the current number inside the div
            let dcurrent = parseInt(dcount.textContent);
            let ucurrent = parseInt(ucount.textContent);
            // Increment the number
            
            up.addEventListener('click', function() {
                if (up.classList.contains("unfill")) {
                    up.classList.add("fill");
                    up.classList.remove("unfill");
                    let incrementup = ucurrent + 1;
                    ucount.textContent = decrementup;
                    call = 'operate.php?id=upvote&opr=insert';
                    if (down.classList.contains("fill")){
                        down.classList.remove("fill");
                        down.classList.add("unfill");
                        call = 'operate.php?id=upvote&opr=update';
                        let decrementdown = dcurrent - 1;
                        dcount.textContent = decrementdown;
                    }
                } 
                else if(up.classList.contains("fill")) {
                    up.classList.add("unfill");
                    up.classList.remove("fill");
                    call = 'operate.php?id=upvote&opr=delete';
                    let decrementup = ucurrent - 1;
                    ucount.textContent = decrementup;
                }
                fetch(call)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
            });

            down.addEventListener('click', function() {
                if (down.classList.contains("unfill")) {
                    down.classList.add("fill");
                    down.classList.remove("unfill");
                    call = 'operate.php?id=downvote&opr=insert';
                    let incrementdown = dcurrent + 1;
                    dcount.textContent = incrementdown;
                    if (up.classList.contains("fill")){
                        up.classList.remove("fill");
                        up.classList.add("unfill");
                        call = 'operate.php?id=downvote&opr=update';
                        let decrementup = ucurrent - 1;
                        ucount.textContent = decrementup;
                    }
                } 
                else if(down.classList.contains("fill")) {
                    down.classList.add("unfill");
                    down.classList.remove("fill");
                    call = 'operate.php?id=downvote&opr=delete';
                    let decrementdown = dcurrent - 1;
                    dcount.textContent = decrementdown;
                }
                fetch(call)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                  console.log(data); // Response from PHP file
                  // You can process the response data here
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
            });
            <?php
            $count++;
            }
            ?>
        });
        function callPHP() {
            fetch('test.php')
            .then(response => {
                if (!response.ok) {
                throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                console.log(data); // Response from PHP file
                // You can process the response data here
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        }
    </script>
</html>