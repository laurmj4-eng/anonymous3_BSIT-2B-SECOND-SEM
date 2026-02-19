<?= $this->extend('theme/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>
              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#ordersModal">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>
              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#bounceModal">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>44</h3>
              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#usersModal">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>65</h3>
              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#visitorsModal">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="ordersModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title"><i class="fas fa-shopping-cart"></i> Recent Orders Overview</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <table class="table table-striped table-valign-middle m-0">
          <thead>
          <tr>
            <th>Order ID</th>
            <th>Item</th>
            <th>Status</th>
            <th>Amount</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>OR-9842</td>
            <td>Network Switch Pro</td>
            <td><span class="badge badge-success">Shipped</span></td>
            <td>$299.00</td>
          </tr>
          <tr>
            <td>OR-9841</td>
            <td>Cat6 Ethernet Cable (50ft)</td>
            <td><span class="badge badge-warning">Pending</span></td>
            <td>$25.50</td>
          </tr>
          <tr>
            <td>OR-9840</td>
            <td>Server Rack Cabinet</td>
            <td><span class="badge badge-danger">Cancelled</span></td>
            <td>$850.00</td>
          </tr>
          <tr>
            <td>OR-9839</td>
            <td>Cisco Router 2900 Series</td>
            <td><span class="badge badge-success">Shipped</span></td>
            <td>$1,200.00</td>
          </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="#" class="btn btn-info">View All Orders</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="bounceModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title"><i class="fas fa-chart-line"></i> Bounce Rate Analytics</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>A breakdown of your bounce rate across different pages today.</p>
        
        <div class="progress-group">
          Landing Page / Home
          <span class="float-right"><b>60%</b>/100%</span>
          <div class="progress progress-sm">
            <div class="progress-bar bg-danger" style="width: 60%"></div>
          </div>
        </div>

        <div class="progress-group">
          Products Catalog
          <span class="float-right"><b>20%</b>/100%</span>
          <div class="progress progress-sm">
            <div class="progress-bar bg-success" style="width: 20%"></div>
          </div>
        </div>

        <div class="progress-group">
          Checkout Page
          <span class="float-right"><b>15%</b>/100%</span>
          <div class="progress progress-sm">
            <div class="progress-bar bg-warning" style="width: 15%"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title"><i class="fas fa-users"></i> Latest Registrations</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <ul class="products-list product-list-in-card pl-2 pr-2">
          <li class="item">
            <div class="product-info ml-2">
              <a href="javascript:void(0)" class="product-title">John Doe
                <span class="badge badge-success float-right">Verified</span></a>
              <span class="product-description">
                john.doe@example.com - Registered 10 mins ago
              </span>
            </div>
          </li>
          <li class="item">
            <div class="product-info ml-2">
              <a href="javascript:void(0)" class="product-title">Sarah Smith
                <span class="badge badge-warning float-right">Pending</span></a>
              <span class="product-description">
                sarah.s@example.com - Registered 1 hour ago
              </span>
            </div>
          </li>
          <li class="item">
            <div class="product-info ml-2">
              <a href="javascript:void(0)" class="product-title">Michael Tech
                <span class="badge badge-success float-right">Verified</span></a>
              <span class="product-description">
                mike.tech@example.com - Registered 3 hours ago
              </span>
            </div>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?= base_url('users') ?>" class="btn btn-warning">Manage Users</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="visitorsModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title"><i class="fas fa-globe"></i> Traffic Sources</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <table class="table table-sm m-0">
          <thead>
            <tr>
              <th>Browser</th>
              <th>Visitors</th>
              <th style="width: 40px">Trend</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><i class="fab fa-chrome text-primary mr-2"></i> Chrome</td>
              <td>42</td>
              <td><i class="fas fa-arrow-up text-success"></i></td>
            </tr>
            <tr>
              <td><i class="fab fa-firefox text-warning mr-2"></i> Firefox</td>
              <td>12</td>
              <td><i class="fas fa-arrow-down text-danger"></i></td>
            </tr>
            <tr>
              <td><i class="fab fa-safari text-info mr-2"></i> Safari</td>
              <td>8</td>
              <td><i class="fas fa-arrow-up text-success"></i></td>
            </tr>
            <tr>
              <td><i class="fab fa-edge text-primary mr-2"></i> Edge</td>
              <td>3</td>
              <td><i class="fas fa-minus text-secondary"></i></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>