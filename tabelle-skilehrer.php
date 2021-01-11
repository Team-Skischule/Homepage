
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>


  <style>
  body {
    margin: 0;
  }

  nav {
    background-color: antiquewhite;
    height: 3vh;
    padding: 20p, 0 20px 20px;
  }

  .container {
    background-color: beige;
    height: 100vh;
    padding: 20px 0 20px 20px;
  }

  main {
    top: 50%;
    left: 50%;
  }

  body {
    font-family: sans-serif;
  }

  td,
  th {
    padding: 10px !important;
    border-bottom: 1px solid rgb(0, 0, 0);
  }
  td,
  th {
    border-right: 1px solid black;
  }
  td:first-child,
  th:first-child {
    border-left: 1px solid black;
  }

  .skitabelle {
    background-color: aliceblue;
    padding: 2rem;
    
  }

  .skitabelle table {
    padding: 0px;
    margin: 1rem;
    font-size: 1em;
    border: 1px solid black;
    border-spacing: 0 !important;
  }

  .skitabelle .steuerung {
    margin: 1rem;
  }

  h1 {
    text-align: center;
  }
</style>
</head>
<body>
  <nav>
    <div class="topnav">
      <a href="http://localhost/index.html">Return to Home</a>
    </div>
  </nav>

  
  <div class="skitabelle">
    <div class="steuerung">
      <h1>Skilehrer Tabelle</h1>
      <hr />
      <button onclick="next_week(startDate)">Nächste Woche</button>
      <button onclick="prev_week(startDate)">Vorherige Woche</button><br />
      <hr />
      <button onclick="switchToMonthView()">Monat</button>
      <button onclick="weekView()">Woche</button>

      <hr />

      <button onclick="myStopFunction()">Stop timer</button>
      <hr>
    </div>
    <table></table>
  </div>

  <footer id="footer">Footer</footer>
  <script src="tabelle-skilehrer.js"></script>
</body>
</html>





