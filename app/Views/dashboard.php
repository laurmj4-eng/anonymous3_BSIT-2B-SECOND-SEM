<?= $this->extend('theme/template') ?>

<?= $this->section('content') ?>

<style>
  /* Smooth hover effect for stat boxes */
  .hover-lift {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
  }
  .hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
  }
  
  /* Modern Gradient Welcome Banner */
  .welcome-banner {
    background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
    color: white;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
  }
  
  .welcome-banner h2 {
    font-weight: 600;
    margin-bottom: 5px;
  }
  
  .welcome-banner p {
    margin: 0;
    opacity: 0.9;
  }
</style>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark font-weight-bold">System Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <section class="content">
    <div class="container-fluid">
        
      <div class="row">
        <div class="col-12">
            <div class="welcome-banner d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h2>Welcome back, Administrator! 👋</h2>
                    <p>Here is an overview of your school's data and recent activities for today.</p>
                </div>
                <div class="d-none d-md-block text-right">
                    <h4 class="mb-0" id="liveClock">--:--</h4>
                    <small id="liveDate">Loading date...</small>
                </div>
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
          <div class="small-box bg-info hover-lift shadow-sm">
            <div class="inner">
              <h3><?= esc($total_students ?? 0) ?></h3>
              <p>Total Students</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-graduate"></i>
            </div>
            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#studentsModal">
                Manage Students <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-12">
          <div class="small-box bg-success hover-lift shadow-sm">
            <div class="inner">
              <h3><?= esc($total_teachers ?? 0) ?></h3>
              <p>Active Teachers</p>
            </div>
            <div class="icon">
              <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#teachersModal">
                Manage Teachers <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-12">
          <div class="small-box bg-warning hover-lift shadow-sm">
            <div class="inner">
              <h3 class="text-dark"><?= esc($total_parents ?? 0) ?></h3>
              <p class="text-dark">Registered Parents</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-friends text-dark" style="opacity: 0.4;"></i>
            </div>
            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#parentsModal" style="color: #333 !important;">
                Manage Parents <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-12">
          <div class="small-box bg-danger hover-lift shadow-sm">
            <div class="inner">
              <h3><?= esc($total_staff ?? 0) ?></h3>
              <p>Admin & Staff</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-tie"></i>
            </div>
            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#staffModal">
                Manage Staff <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-lg-7">
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header border-0 bg-white pt-3 pb-2">
                    <h3 class="card-title font-weight-bold text-secondary">
                        <i class="fas fa-chart-bar mr-1 text-primary"></i> Population Overview
                    </h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="populationChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header border-0 bg-white pt-3 pb-2">
                    <h3 class="card-title font-weight-bold text-secondary">
                        <i class="fas fa-chart-pie mr-1 text-success"></i> User Distribution
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="distributionChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
      </div>

    </div>
  </section>
</div>

<div class="modal fade" id="studentsModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-info text-white border-0">
        <h5 class="modal-title font-weight-bold"><i class="fas fa-user-graduate mr-2"></i> Students Overview</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-4">
        <div class="display-4 text-info font-weight-bold mb-2"><?= esc($total_students ?? 0) ?></div>
        <p class="lead">Total Enrolled Students</p>
        <p class="text-muted text-sm">Use the management module to enroll new students, edit profiles, or export records.</p>
      </div>
      <div class="modal-footer border-0 bg-light justify-content-between">
        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-dismiss="modal">Close</button>
        <a href="<?= base_url('student') ?>" class="btn btn-info rounded-pill px-4 shadow-sm"><i class="fas fa-cog"></i> Go to Students</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="teachersModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-success text-white border-0">
        <h5 class="modal-title font-weight-bold"><i class="fas fa-chalkboard-teacher mr-2"></i> Teachers Overview</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-4">
        <div class="display-4 text-success font-weight-bold mb-2"><?= esc($total_teachers ?? 0) ?></div>
        <p class="lead">Active Teaching Staff</p>
        <p class="text-muted text-sm">Access the dashboard to update schedules, assignments, and personnel details.</p>
      </div>
      <div class="modal-footer border-0 bg-light justify-content-between">
        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-dismiss="modal">Close</button>
        <a href="<?= base_url('teacher') ?>" class="btn btn-success rounded-pill px-4 shadow-sm"><i class="fas fa-cog"></i> Go to Teachers</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="parentsModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-warning border-0">
        <h5 class="modal-title font-weight-bold text-dark"><i class="fas fa-user-friends mr-2"></i> Parents Overview</h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-4">
        <div class="display-4 text-warning font-weight-bold mb-2"><?= esc($total_parents ?? 0) ?></div>
        <p class="lead text-dark">Registered Guardians</p>
        <p class="text-muted text-sm">Manage emergency contacts and link parent accounts to student records.</p>
      </div>
      <div class="modal-footer border-0 bg-light justify-content-between">
        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-dismiss="modal">Close</button>
        <a href="<?= base_url('parents') ?>" class="btn btn-warning rounded-pill px-4 shadow-sm text-dark"><i class="fas fa-cog"></i> Go to Parents</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="staffModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-danger text-white border-0">
        <h5 class="modal-title font-weight-bold"><i class="fas fa-user-tie mr-2"></i> Staff Overview</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-4">
        <div class="display-4 text-danger font-weight-bold mb-2"><?= esc($total_staff ?? 0) ?></div>
        <p class="lead">Administrative Support</p>
        <p class="text-muted text-sm">Manage non-teaching personnel, maintenance, and administrative accounts.</p>
      </div>
      <div class="modal-footer border-0 bg-light justify-content-between">
        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-dismiss="modal">Close</button>
        <a href="<?= base_url('staff') ?>" class="btn btn-danger rounded-pill px-4 shadow-sm"><i class="fas fa-cog"></i> Go to Staff</a>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
$(function () {
    // 1. Live Clock & Date Function
    function updateClock() {
        const now = new Date();
        const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        
        $('#liveClock').text(now.toLocaleTimeString([], timeOptions));
        $('#liveDate').text(now.toLocaleDateString([], dateOptions));
    }
    setInterval(updateClock, 1000);
    updateClock();

    // 2. Fetch PHP variables for Charts
    var countStudents = <?= esc($total_students ?? 0) ?>;
    var countTeachers = <?= esc($total_teachers ?? 0) ?>;
    var countParents  = <?= esc($total_parents ?? 0) ?>;
    var countStaff    = <?= esc($total_staff ?? 0) ?>;

    // 3. Initialize Bar Chart
    var barChartCanvas = $('#populationChart').get(0).getContext('2d')
    var barChartData = {
      labels  : ['Students', 'Teachers', 'Parents', 'Staff'],
      datasets: [
        {
          label               : 'Total Count',
          backgroundColor     : ['#17a2b8', '#28a745', '#ffc107', '#dc3545'],
          borderColor         : ['#117a8b', '#1e7e34', '#d39e00', '#bd2130'],
          borderWidth         : 1,
          data                : [countStudents, countTeachers, countParents, countStaff]
        }
      ]
    }
    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
      plugins: {
        legend: { display: false }
      },
      scales: {
        y: { beginAtZero: true, ticks: { precision: 0 } }
      }
    }
    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    // 4. Initialize Donut Chart
    var donutChartCanvas = $('#distributionChart').get(0).getContext('2d')
    var donutData        = {
      labels: ['Students', 'Teachers', 'Parents', 'Staff'],
      datasets: [
        {
          data: [countStudents, countTeachers, countParents, countStaff],
          backgroundColor : ['#17a2b8', '#28a745', '#ffc107', '#dc3545'],
          hoverOffset: 4
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
      plugins: {
          legend: { position: 'right' }
      }
    }
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })
})
</script>
<?= $this->endSection() ?>