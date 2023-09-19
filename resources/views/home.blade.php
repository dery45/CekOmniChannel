@extends('layouts.admin')

@section('content-header', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="startDate">Tanggal Mulai:</label>
                <div class="input-group">
                    <input type="date" class="form-control" id="startDate" name="start_date">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="endDate">Tanggal Akhir:</label>
                <div class="input-group">
                    <input type="date" class="form-control" id="endDate" name="end_date">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box small-box-custom">
                <div class="inner">
                    <h3 id="totalOrder" style="color: #fff;"></h3>
                    <p style="color: #fff;">Total Order</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag" style="color: #fff;"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box small-box-custom">
                <div class="inner">
                    <h3 id="totalIncome" style="color: #fff;"></h3>
                    <p style="color: #fff;">Total Barang Terjual</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars" style="color: #fff;"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box small-box-custom">
                <div class="inner">
                    <h3 id="incomeToday" style="color: #fff;"></h3>
                    <p style="color: #fff;">Total Pendapatan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph" style="color: #fff;"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box small-box-custom">
                <div class="inner">
                    <h3 id="totalCustomers" style="color: #fff;"></h3>
                    <p style="color: #fff;">Profit</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add" style="color: #fff;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <canvas id="incomeChart" width="400" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <canvas id="orderQuantityChart" width="400" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="paymentStatsChart" width="400" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table id="topProductsTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
        var incomeChart = null;
        var orderQuantityChart = null;
        var stockHistoryChart = null;
        var selectedProductId = null;

        // Fetch data on page load
        fetchDataDashboardBox();
        fetchDataIncomeProfit();
        fetchDataOrderQuantity();
        fetchDataPaymentStats();
        fetchTopProducts();
        fetchStockHistory();

        // Fetch data when the user selects a date
        $('#startDate, #endDate').change(function () {
            fetchDataDashboardBox();
            fetchDataIncomeProfit();
            fetchDataOrderQuantity();
            fetchDataPaymentStats();
            fetchTopProducts();
            fetchStockHistory();
        });

          // Fetch data when the user selects a product
        $('#productId').change(function () {
            fetchStockHistory();
        });

        function fetchDataDashboardBox() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            var url = 'http://127.0.0.1:5551/dashboardbox';

            if (startDate && endDate) {
                url += '?start_date=' + startDate + '&end_date=' + endDate;
            }

            console.log('Fetching dashboard box data from API...');
            console.log('URL:', url);

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    console.log('API response:', response);
                    updateBoxes(response);
                },
                error: function (xhr, status, error) {
                    console.log('Error fetching dashboard box data from API:', error);
                }
            });
        }

        function fetchDataIncomeProfit() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            var url = 'http://127.0.0.1:5551/income-profit';

            if (startDate && endDate) {
                url += '?start_date=' + startDate + '&end_date=' + endDate;
            }

            console.log('Fetching income-profit data from API...');
            console.log('URL:', url);

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    console.log('API response:', response);
                    createOrUpdateChart(response);
                },
                error: function (xhr, status, error) {
                    console.log('Error fetching income-profit data from API:', error);
                }
            });
        }

        function updateBoxes(data) {
            var totalOrder = parseInt(data['Total Transaksi']);
            var totalIncome = parseInt(data['Total Barang Terjual']);
            var incomeToday = parseFloat(data['Total Pendapatan']);
            var totalCustomers = parseFloat(data['Profit']);

            $('#totalOrder').text(totalOrder);
            $('#totalIncome').text(totalIncome);
            $('#incomeToday').text(incomeToday.toFixed(2));
            $('#totalCustomers').text(totalCustomers.toFixed(2));
        }

        function createOrUpdateChart(data) {
          var labels = Object.keys(data);
          var incomeValues = Object.values(data).map(function (item) {
              return parseFloat(item.income);
          });
          var profitValues = Object.values(data).map(function (item) {
              return parseFloat(item.profit);
          });

          var ctx = document.getElementById('incomeChart').getContext('2d');

          if (incomeChart) {
              incomeChart.destroy();
          }

          incomeChart = new Chart(ctx, {
              type: 'line',
              data: {
                  labels: labels,
                  datasets: [{
                      label: 'Pendapatan',
                      data: incomeValues,
                      backgroundColor: 'rgba(54, 162, 235, 0.2)',
                      borderColor: 'rgba(85, 65, 215, 1)',
                      fill: true,
                      lineTension: 0.3 // Adjust the tension here (0.1 to 0.5 recommended)
                  }, {
                      label: 'Keuntungan',
                      data: profitValues,
                      backgroundColor: 'rgba(255, 99, 132, 0.2)',
                      borderColor: 'rgba(255, 99, 132, 1)',
                      fill: true,
                      lineTension: 0.3 // Adjust the tension here (0.1 to 0.5 recommended)
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false
              }
          });
      }
       function fetchDataOrderQuantity() {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                var url = 'http://127.0.0.1:5551/order-quantity';

                if (startDate && endDate) {
                    url += '?start_date=' + startDate + '&end_date=' + endDate;
                }

                console.log('Fetching order-quantity data from API...');
                console.log('URL:', url);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        console.log('API response:', response);
                        createOrUpdateOrderQuantityChart(response);
                    },
                    error: function (xhr, status, error) {
                        console.log('Error fetching order-quantity data from API:', error);
                    }
                });
            }

            function createOrUpdateOrderQuantityChart(data) {
                var labels = Object.keys(data);
                var orderCountData = Object.values(data).map(item => parseInt(item.order_count));
                var qtyCountData = Object.values(data).map(item => parseInt(item.qty_count));
                var maxCount = Math.max(...orderCountData, ...qtyCountData);
                var barColors = ['rgba(85, 65, 215, 1)', 'rgba(255, 99, 132, 0.8)'];

                var ctx = document.getElementById('orderQuantityChart').getContext('2d');

                if (orderQuantityChart) {
                    orderQuantityChart.destroy();
                }

                orderQuantityChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Jumlah Pesanan',
                                data: orderCountData,
                                backgroundColor: barColors[0],
                                borderWidth: 0,
                            },
                            {
                                label: 'Jumlah Barang',
                                data: qtyCountData,
                                backgroundColor: barColors[1],
                                borderWidth: 0,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                stacked: true,
                                grid: {
                                    display: false,
                                },
                            },
                            y: {
                                stacked: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)',
         
         
         
         
                                },
                                ticks: {
                                    beginAtZero: true,
                                    stepSize: Math.ceil(maxCount / 5),
                                },
                            },
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom',
                            },
                        },
                    },
                });
            }
            function fetchDataPaymentStats() {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                var url = 'http://127.0.0.1:5551/payment-stats';

                if (startDate && endDate) {
                    url += '?start_date=' + startDate + '&end_date=' + endDate;
                }

                console.log('Fetching payment stats data from API...');
                console.log('URL:', url);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        console.log('API response:', response);
                        createOrUpdatePaymentStatsChart(response);
                    },
                    error: function (xhr, status, error) {
                        console.log('Error fetching payment stats data from API:', error);
                    }
                });
            }

            function createOrUpdatePaymentStatsChart(data) {
            var labels = Object.keys(data);
            var values = Object.values(data).map(item => parseFloat(item.total));
            var percentages = Object.values(data).map(item => parseFloat(item.percent));

            var ctx = document.getElementById('paymentStatsChart').getContext('2d');
            var paymentStatsChart = Chart.getChart(ctx);

            if (paymentStatsChart) {
                paymentStatsChart.data.labels = labels;
                paymentStatsChart.data.datasets[0].data = values;
                paymentStatsChart.data.datasets[0].percentages = percentages;
                paymentStatsChart.update();
            } else {
                paymentStatsChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            percentages: percentages,
                            backgroundColor: ['rgba(85, 65, 215, 1)', 'rgba(255, 99, 132, 0.8)'], // Adjust the colors as needed
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        var label = context.label || '';
                                        var value = parseFloat(context.parsed.toFixed(2)).toLocaleString('en-US');
                                        var percentage = parseFloat(context.dataset.percentages[context.dataIndex].toFixed(2)).toLocaleString('en-US');

                                        if (label) {
                                            label += ':\n';
                                        }
                                        label += 'Jumlah: ' + value + '\n';
                                        label += 'Persentase: ' + percentage + '%';
                                        return label;
                                    }
                                }
                            }
                        },
                        interaction: {
                            mode: 'index', // Show tooltip for the nearest data item
                            intersect: false,
                        },
                    }
                });
            }
        }
        function fetchTopProducts() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            var url = 'http://127.0.0.1:5551/product-quantity';

            if (startDate && endDate) {
                url += '?start_date=' + startDate + '&end_date=' + endDate;
            }

            console.log('Fetching top products data from API...');
            console.log('URL:', url);

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    console.log('API response:', response);
                    updateTopProductsTable(response);
                },
                error: function (xhr, status, error) {
                    console.log('Error fetching top products data from API:', error);
                }
            });
        }

        function createOrUpdateTopProductsChart(data) {
            var labels = Object.keys(data);
            var quantityValues = Object.values(data).map(function (item) {
                return parseInt(item.qty_count);
            });

            var ctx = document.getElementById('topProductsChart').getContext('2d');

            if (topProductsChart) {
                topProductsChart.destroy();
            }

            topProductsChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: quantityValues,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    var label = context.label || '';
                                    var value = parseFloat(context.parsed.toFixed(2)).toLocaleString('en-US');

                                    if (label) {
                                        label += ':\n';
                                    }
                                    label += 'Quantity: ' + value;
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }

        function updateTopProductsTable(data) {
            var tableBody = $('#topProductsTable tbody');
            tableBody.empty();

            Object.entries(data).forEach(([product, values]) => {
                var row = $('<tr></tr>');
                var productCell = $('<td></td>').text(product);
                var quantityCell = $('<td></td>').text(parseInt(values.qty_count));

                row.append(productCell, quantityCell);
                tableBody.append(row);
            });
        }
        function fetchStockHistory() {
            var productId = $('#productId').val();
            var url = 'http://127.0.0.1:5551/stock_history/' + productId;

            console.log('Fetching stock history data from API...');
            console.log('URL:', url);

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    console.log('API response:', response);
                    createOrUpdateStockHistoryChart(response);
                },
                error: function (xhr, status, error) {
                    console.log('Error fetching stock history data from API:', error);
                }
            });
        }

        function createOrUpdateStockHistoryChart(data) {
            var labels = data.map(function (item) {
                return item.created_at;
            });
            var quantityValues = data.map(function (item) {
                return parseInt(item.quantity);
            });

            var ctx = document.getElementById('stockHistoryChart').getContext('2d');

            if (stockHistoryChart) {
                stockHistoryChart.destroy();
            }

            stockHistoryChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Quantity',
                        data: quantityValues,
                        backgroundColor: 'rgba(75, 192, 192, 0.8)', // Adjust the color as needed
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: true,
                            grid: {
                                display: false,
                            },
                        },
                        y: {
                            stacked: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                            },
                        },
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                },
            });
        }
    });
</script>

<style>
    /* Add your custom styles here */
    .small-box-custom {
        background-color: #5541D7;
        color: #fff;
        font-family: 'Roboto', sans-serif;
        text-align: center;
        padding: 20px 0;
        border-radius: 5px;
        height: 150px;
    }

    .small-box-custom p {
        margin: 0;
    }

    .input-group-text {
        background-color: #5541D7;
        color: #fff;
        border: none;
    }

    .form-control {
        border: 1px solid #5541D7;
    }
</style>


@endsection