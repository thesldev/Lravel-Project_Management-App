<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Claps Client Portal</title>

    <!-- Custom fonts for this template-->
    <link
      href="vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- project card css -->
    <link rel="stylesheet" href="{{ asset('css/project-card.css') }}">
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <x-client-side-bar />
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <x-topbar />
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <div
              class="d-sm-flex align-items-center justify-content-between mb-4"
            >
              <h1 class="h3 mb-0 text-gray-800">My Dashboard</h1>
            </div>

            <!-- Content Row -->
            <div class="row">
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                        >
                          My Projects
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ $totalProjects }}
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (yearly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    My Services
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{$totalServices}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cogs fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

              <!-- task card-->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-info text-uppercase mb-1"
                        >
                          Project Tickets (Active)
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div
                              class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                            >
                              {{ $totalProjectTickets }}
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- team member count -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-warning text-uppercase mb-1"
                        >
                          Service Tickets (Active)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ $totalServiceTickets }}
                        </div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Content Row -->

            <div class="row">
              <!-- Area Chart -->
              <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tickets Overview</h6>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="chart-area">
                      <canvas id="myAreaChart"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pie Chart -->
              <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Active Ticket's Status</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="ticketStatusPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2"><i class="fas fa-circle text-primary"></i> Open</span>
                            <span class="mr-2"><i class="fas fa-circle text-warning"></i> In Progress</span>
                            <span class="mr-2"><i class="fas fa-circle text-secondary"></i> On Hold</span>
                            <span class="mr-2"><i class="fas fa-circle text-success"></i> Resolved</span>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="row">
              <div class="col-xl col-lg">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Announcements</h6>
                    <div class="dropdown no-arrow">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Announcements:</div>
                        <a class="dropdown-item" href="#">Today</a>
                        <a class="dropdown-item" href="#">This Week</a>
                        <a class="dropdown-item" href="#">This Month</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Old Topics</a>
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    
                  </div>
                </div>
              </div>
          </div>
          </div>

          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <x-footer />
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <x-logoutModule />
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const monthlyTicketLabels = <?php echo json_encode($ticketLabels); ?>;
        const monthlyTicketCounts = <?php echo json_encode($ticketCounts); ?>;

        const ctx = document.getElementById('myAreaChart').getContext('2d');
        const myAreaChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: monthlyTicketLabels,
                datasets: [{
                    label: 'Monthly Tickets',
                    data: monthlyTicketCounts,
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointRadius: 3,
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHitRadius: 10,
                    pointBorderWidth: 2
                }]
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { maxTicksLimit: 12 }
                    },
                    y: {
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            callback: function(value) {
                                return value;
                            }
                        },
                        grid: {
                            color: 'rgba(234, 236, 244, 1)',
                            zeroLineColor: 'rgba(234, 236, 244, 1)',
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgb(255,255,255)',
                        bodyColor: '#858796',
                        titleMarginBottom: 10,
                        titleFont: { size: 14 },
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>

    <!-- script files for pie chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Pass PHP data to JavaScript
        const ticketData = <?= json_encode([
            $chartData['Open'], 
            $chartData['In Progress'], 
            $chartData['On Hold'], 
            $chartData['Resolved']
        ]); ?>;

        const ctp = document.getElementById("ticketStatusPieChart").getContext("2d");

        const ticketStatusPieChart = new Chart(ctp, {
            type: 'pie',
            data: {
                labels: ['Open', 'In Progress', 'On Hold', 'Resolved'],
                datasets: [{
                    data: ticketData,
                    backgroundColor: ['#4e73df', '#f6c23e', '#858796', '#1cc88a'],
                    hoverBackgroundColor: ['#2e59d9', '#f4b619', '#6c757d', '#17a673'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false // Disable the legend
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const label = tooltipItem.label || '';
                                const value = tooltipItem.raw || 0;
                                return `${label}: ${value} Tickets`;
                            }
                        }
                    }
                }
            }
        });
    </script>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
  </body>
</html>
