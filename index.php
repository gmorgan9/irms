<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link href="assets/fontawesome/css/all.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/style.css?v=1.67">

    <!-- Bootstrap Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Home</title>
</head>
<body>
    <div class="header">
        <h2 class="logo">
            Incident Record Management System
            <a href="/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        </h2>
    </div>

<div class="record_incident">
    <a href=""><button class="btn btn-primary rec">Record Incident</button></a>
</div>

<br><br><br><br>

<div class="col d-flex justify-content-center">
<div class="row row_one">
<div class="card" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="col d-flex justify-content-center">
                <i class="fa-solid fa-envelope-open fa-8x"></i> <br>
            </div>
            <div class="col d-flex justify-content-center">
                <a href="#" class="btn stretched-link">Open Incidents</a>
            </div>
        </div>
    </div>
</div>
<div class="card" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="col d-flex justify-content-center">
                <i class="fa-solid fa-envelope-circle-check fa-8x"></i> <br>
            </div>
            <div class="col d-flex justify-content-center">
                <a href="#" class="btn stretched-link">Closed Incidents</a>
            </div>
        </div>
    </div>
</div>
<div class="card" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="col d-flex justify-content-center">
                <i class="fa-solid fa-envelopes-bulk fa-8x"></i> <br>
            </div>
            <div class="col d-flex justify-content-center">
                <a href="#" class="btn stretched-link">All Incidents</a>
            </div>
        </div>
    </div>
</div>
  </div>
  </div>
  <br>
<!-- Row 2 -->
<div class="col d-flex justify-content-center">
<div class="row">
<div class="card" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="col d-flex justify-content-center">
                <i class="fa-solid fa-file-invoice fa-8x"></i> <br>
            </div>
            <div class="col d-flex justify-content-center">
                <a href="#" class="btn stretched-link" style="width: 150px;">Incident Priority Report</a>
            </div>
        </div>
    </div>
</div>
<div class="card" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="col d-flex justify-content-center">
                <i class="fa-solid fa-file-lines fa-8x"></i> <br>
            </div>
            <div class="col d-flex justify-content-center">
                <a href="#" class="btn stretched-link">Other Reports</a>
            </div>
        </div>
    </div>
</div>
<div class="card" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="col d-flex justify-content-center">
                <i class="fa-solid fa-note-sticky fa-8x"></i> <br>
            </div>
            <div class="col d-flex justify-content-center">
                <a href="#" class="btn stretched-link">Incident Notes</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>



</body>
</html>