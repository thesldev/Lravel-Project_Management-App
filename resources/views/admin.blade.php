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

    <title>SB Admin 2 - Dashboard</title>

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
      <x-side-bar />
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
              <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>
              <a
                href="#"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                ><i class="fas fa-download fa-sm text-white-50"></i> Generate
                Report</a
              >
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
                          Earnings (Monthly)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            ${{ number_format($monthlyEarnings, 2) }}
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
                                    Earnings (Annual)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    ${{ number_format($totalBudget, 2) }} <!-- Display total budget -->
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                          Total Projects
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div
                              class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                            >
                              {{ $totalProjects }}
                            </div>
                          </div>
                          <div class="col">
                            <div class="progress progress-sm mr-2">
                              <div
                                class="progress-bar bg-info"
                                role="progressbar"
                                style="width: 50%"
                                aria-valuenow="50"
                                aria-valuemin="0"
                                aria-valuemax="100"
                              ></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i
                          class="fas fa-clipboard-list fa-2x text-gray-300"
                        ></i>
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
                          Our Team
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ $totalEmployees }}
                        </div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-users fa-2x text-gray-300"></i>
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
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                    <div class="dropdown no-arrow">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
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
                    <h6 class="m-0 font-weight-bold text-primary">Project Status</h6>
                    <div class="dropdown no-arrow">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                      <canvas id="projectStatusPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                      <span class="mr-2"><i class="fas fa-circle text-primary"></i> Completed</span>
                      <span class="mr-2"><i class="fas fa-circle text-success"></i> Ongoing</span>
                      <span class="mr-2"><i class="fas fa-circle text-info"></i> Pending</span>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <!-- Content Row -->
            <div class="row">
              <!-- Content Column -->
              <div class="col-lg-6 mb-4">
                <!-- Project priority order-->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Top Projects</h6>
                  </div>
                  <div class="card-body">
                      <!-- Create a responsive grid -->
                      <div class="row">
                          @foreach ($projectData as $project)
                              <div class="col-md-6 col-lg-4 mb-4">
                                  <!-- Individual project card -->
                                  <div class="card shadow-sm rounded border-light h-100">
                                      <div class="card-body">
                                          <h5 class="card-title text-dark font-weight-bold">{{ $project['name'] }}</h5>
                                          <p class="card-text">
                                              <span class="badge badge-primary">{{ $project['priority'] }} Priority</span>
                                          </p>
                                          <ul class="list-unstyled">
                                              <li>
                                                  <strong>Budget: </strong> {{ $project['budget'] }}
                                              </li>
                                              <li>
                                                  <strong>Employees: </strong> {{ $project['employeeCount'] }}
                                              </li>
                                              <li>
                                                  <strong>End Date: </strong> {{ $project['endDate'] }}
                                              </li>
                                          </ul>
                                      </div>
                                      <div class="card-footer text-right">
                                          <button class="btn btn-outline-primary btn-sm">View Details</button>
                                      </div>
                                  </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
              </div>

              <div class="col-lg-6 mb-4">
                <!-- Illustrations -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                      Illustrations
                    </h6>
                  </div>
                  <div class="card-body">
                    <div class="text-center">
                      <img
                        class="img-fluid px-3 px-sm-4 mt-3 mb-4"
                        style="width: 25rem"
                        src="img/undraw_posting_photo.svg"
                        alt="..."
                      />
                    </div>
                    <p>
                      Add some quality, svg illustrations to your project
                      courtesy of
                      <a
                        target="_blank"
                        rel="nofollow"
                        href="https://undraw.co/"
                        >unDraw</a
                      >, a constantly updated collection of beautiful svg images
                      that you can use completely free and without attribution!
                    </p>
                    <a target="_blank" rel="nofollow" href="https://undraw.co/"
                      >Browse Illustrations on unDraw &rarr;</a
                    >
                  </div>
                </div>

                <!-- Approach -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                      Development Approach
                    </h6>
                  </div>
                  <div class="card-body">
                    <p>
                      SB Admin 2 makes extensive use of Bootstrap 4 utility
                      classes in order to reduce CSS bloat and poor page
                      performance. Custom CSS classes are used to create custom
                      components and custom utility classes.
                    </p>
                    <p class="mb-0">
                      Before working with this theme, you should become familiar
                      with the Bootstrap framework, especially the utility
                      classes.
                    </p>
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

    

    <!-- scripts for area chart -->
    <script>
        // Pass the PHP data to JavaScript
        const monthlyData = <?= json_encode(array_values($monthlyData)); ?>;
        const months = <?= json_encode(array_keys($monthlyData)); ?>;
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data for the chart
        const ctx = document.getElementById('myAreaChart').getContext('2d');
        const myAreaChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months.map(month => {
                    // Convert numeric months to their names
                    const date = new Date(0);
                    date.setMonth(month - 1);
                    return date.toLocaleString('default', { month: 'long' });
                }),
                datasets: [{
                    label: 'Earnings',
                    data: monthlyData,
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    pointRadius: 3,
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    lineTension: 0.3
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
                        grid: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 12
                        }
                    },
                    y: {
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            callback: function(value) {
                                return '$' + value.toLocaleString(); // Format as currency
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
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgb(255,255,255)',
                        bodyColor: '#858796',
                        titleMarginBottom: 10,
                        titleFont: { size: 14 },
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        caretPadding: 10,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': $' + context.raw.toLocaleString();
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
      const projectData = <?= json_encode([
          $chartData['completed'], 
          $chartData['ongoing'], 
          $chartData['pending']
      ]); ?>;

      var ctp = document.getElementById("projectStatusPieChart").getContext("2d");

      var projectStatusPieChart = new Chart(ctp, {
        type: 'pie',
        data: {
          datasets: [{
            data: projectData,
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
          }],
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            tooltip: {
              callbacks: {
                label: function(tooltipItem) {
                  return tooltipItem.label + ": " + tooltipItem.raw + " Projects";
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
