<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Home | MS Store System</title>
        <?php include('header.php');?>
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <?php $home='active'; include('sidebar.php');?>
                <div class="container-fluid p-3">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card" style="border-radius: 8px;">
                                <div class="card-header">
                                    Total List Products
                                </div>
                                <div class="card-footer">
                                    <h1 class="text-center"><?php echo $tileObj->totalProduct();?></h1>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-4 mb-4">
                            <div class="card" style="border-radius: 8px;">
                                <div class="card-header">
                                    Total List Category
                                </div>
                                <div class="card-footer">
                                    <h1 class="text-center"><?php echo $tileObj->totalCategory();?></h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card" style="border-radius: 8px;">
                                <div class="card-header">
                                    Total Inventory Reports
                                </div>
                                <div class="card-footer">
                                    <h1 class="text-center"><?php echo $tileObj->totalLog();?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="border-radius: 8px;">
                        <div class="card-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const labels = [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'June',
                'July',
                'Aug',
                'Sept',
                'Oct',
                'Nov',
                'Dec'
            ];

            const data = {
                labels: labels,
                datasets: [{
                label: 'TOTAL MONTHLY SALES INCOME',
                backgroundColor: 'blue',
                borderColor: 'gray',
                data: [
                    <?php echo $tileObj->getSalesBarGraph('01');?>,
                    <?php echo $tileObj->getSalesBarGraph('02');?>, 
                    <?php echo $tileObj->getSalesBarGraph('03');?>, 
                    <?php echo $tileObj->getSalesBarGraph('04');?>, 
                    <?php echo $tileObj->getSalesBarGraph('05');?>, 
                    <?php echo $tileObj->getSalesBarGraph('06');?>, 
                    <?php echo $tileObj->getSalesBarGraph('07');?>, 
                    <?php echo $tileObj->getSalesBarGraph('08');?>, 
                    <?php echo $tileObj->getSalesBarGraph('09');?>, 
                    <?php echo $tileObj->getSalesBarGraph('10');?>, 
                    <?php echo $tileObj->getSalesBarGraph('11');?>, 
                    <?php echo $tileObj->getSalesBarGraph('12');?>],
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {}
            };

            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        </script>
        <?php include('footer.php');?>
    </body>
</html>