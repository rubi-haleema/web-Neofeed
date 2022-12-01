{{-- @extends('master') --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css">


    <title>Asteroid Document</title>
</head>

<body>
    <div class="flex h-screen">
        <div class="m-auto">
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-2xl md:max-w-2xl">
                <div style="width: 700px;height: 700px;" >
                    <canvas id="myChart" width="400" height="400" style="border: solid;color: blue;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

    <script>
        var noOfAstroids = <?php echo json_encode($neo_count_by_date_arry_values); ?>;
        var astroidsAppeardate = <?php echo json_encode($neo_count_by_date_arry_keys); ?>;
        //alert(astroidsAppeardate[0]);

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: astroidsAppeardate,
                datasets: [{
                    label: '# of Asteroids',
                    data: noOfAstroids,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>

</html>