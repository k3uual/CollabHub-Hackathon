var mysql = require('mysql');

        var con = mysql.createConnection({
          host: "localhost",
          user: "root",
          password: "",
          database: "collab-hub"
        });

        con.connect(function(err) {
          if (err) throw err;
          var sql = "INSERT INTO `test` (`ins`) VALUES ('1234');";
          con.query(sql, function (err, result) {
            if (err) throw err;
            console.log(result.affectedRows + " record(s) updated");
          });
        });