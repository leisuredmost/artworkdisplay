export function getDataFromMySQL() {
  return new Promise((resolve, reject) => {
      // create the connection to database
      const connection = mysql.createConnection({
          host: 'localhost',
          user: 'root',
          password: '',
          database: 'artwork_display_db'
      });

      connection.connect();

      // query data from the database
      connection.query('SELECT ratings_comments.ratings, ratings_comments.comments, users.users_count FROM ratings_comments JOIN users ON ratings_comments.user_id = users.id',
          function(err, results, fields) {
              if (err) reject(err);
              // close the connection
              connection.end();
              var data = [results[0].ratings, results[0].comments, results[0].users_count];
              resolve(data);
          });
  });
}