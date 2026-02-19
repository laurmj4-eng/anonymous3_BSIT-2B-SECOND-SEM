<?= $this->extend('theme/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Profiling</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">Profiling</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">List of Profiles</h3>
              <div class="float-right">
                <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#AddProfileModal">
                  <i class="fa fa-plus-circle fa fw"></i> Add New
                </button>
              </div>
            </div>
            <div class="card-body">
               <table id="profilingTable" class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th style="display:none;">id</th>
                    <th>Name</th>
                    <th>Birthday</th>
                    <th>Address</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="AddProfileModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form id="addProfileForm">
          <?= csrf_field() ?>
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-plus-circle fa fw"></i> Add New Profile</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required />
              </div>
              <div class="form-group">
                <label>Birthday</label>
                <input type="date" name="birthday" class="form-control" required />
              </div>
              <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-control" rows="3" required></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fas fa-times-circle'></i> Cancel</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><i class="far fa-edit fa fw"></i> Edit Profile</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="editProfileForm">
             <?= csrf_field() ?>
            <div class="modal-body">
              <input type="hidden" id="edit_id" name="id">
              <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" id="edit_name" class="form-control" required />
              </div>
              <div class="form-group">
                <label>Birthday</label>
                <input type="date" class="form-control" id="edit_birthday" name="birthday" required>
              </div>
              <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" id="edit_address" name="address" rows="3" required></textarea>
              </div>        
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fas fa-times-circle'></i> Cancel</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="toasts-top-right fixed" style="position: fixed; top: 1rem; right: 1rem; z-index: 9999;"></div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function () {
    const baseUrl = "<?= base_url() ?>";

    let table = $('#profilingTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: baseUrl + 'profiling/fetchRecords',
            type: 'POST',
            data: function (d) {
                d.<?= csrf_token() ?> = '<?= csrf_hash() ?>'; 
            }
        },
        columns: [
            { data: 'row_number', orderable: false },
            { data: 'id', visible: false },
            { data: 'name' },
            { data: 'birthday' },
            { data: 'address' },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-sm btn-warning edit-btn" data-id="${row.id}">
                            <i class="fas fa-edit" style="color:white;"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">
                            <i class="fas fa-trash"></i>
                        </button>`;
                },
                orderable: false
            }
        ]
    });

    // ==========================================
    // OFFLINE & SYNC LOGIC FOR ADDING PROFILES
    // ==========================================
    
    function saveProfileOffline(formData) {
        let offlineProfiles = JSON.parse(localStorage.getItem('offlineProfiles')) || [];
        offlineProfiles.push(formData);
        localStorage.setItem('offlineProfiles', JSON.stringify(offlineProfiles));
        
        toastr.info('You are offline. Profile saved locally and will sync when online.');
        
        $('#AddProfileModal').modal('hide');
        $('#addProfileForm')[0].reset();
        table.draw(false); 
    }

    function syncOfflineProfiles() {
        let offlineProfiles = JSON.parse(localStorage.getItem('offlineProfiles')) || [];
        
        if (offlineProfiles.length > 0) {
            toastr.info('Network restored. Syncing ' + offlineProfiles.length + ' offline profile(s)...');
            
            let remainingProfiles = [];

            // Process each saved profile
            offlineProfiles.forEach(function(formData) {
                $.ajax({
                    url: baseUrl + 'profiling/save',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.status === 'success') {
                            toastr.success('Offline profile synced successfully!');
                            table.ajax.reload(null, false);
                        } else {
                            toastr.error('Failed to sync a profile: ' + response.message);
                        }
                    },
                    error: function() {
                        // Keep in queue if network fails again during sync
                        remainingProfiles.push(formData);
                    }
                });
            });

            // Update localStorage (clears successful ones, keeps failed ones)
            localStorage.setItem('offlineProfiles', JSON.stringify(remainingProfiles));
        }
    }

    // Listeners for network status
    window.addEventListener('online', syncOfflineProfiles);

    if (navigator.onLine) {
        syncOfflineProfiles();
    }

    // Add Profile Submit Event
    $('#addProfileForm').submit(function (e) {
        e.preventDefault();
        
        let formData = $(this).serialize();

        if (!navigator.onLine) {
            // Offline path
            saveProfileOffline(formData);
        } else {
            // Online path
            $.ajax({
                url: baseUrl + 'profiling/save',
                type: 'POST',
                data: formData,
                success: function (response) {
                    if (response.status === 'success') {
                        $('#AddProfileModal').modal('hide');
                        $('#addProfileForm')[0].reset();
                        table.ajax.reload();
                        toastr.success('Profile added successfully!');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    // Fallback to offline save if request drops mid-submission
                    saveProfileOffline(formData);
                }
            });
        }
    });

    // ==========================================
    // EXISTING EDIT & DELETE LOGIC
    // ==========================================

    // Fetch Data for Edit
    $('#profilingTable').on('click', '.edit-btn', function () {
        let id = $(this).data('id');
        $.get(baseUrl + 'profiling/edit/' + id, function (response) {
            $('#edit_id').val(response.data.id);
            $('#edit_name').val(response.data.name);
            $('#edit_birthday').val(response.data.birthday);
            $('#edit_address').val(response.data.address);
            $('#editProfileModal').modal('show');
        });
    });

    // Update Profile
    $('#editProfileForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: baseUrl + 'profiling/update',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    $('#editProfileModal').modal('hide');
                    table.ajax.reload();
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    });

    // Delete Profile
    $('#profilingTable').on('click', '.delete-btn', function () {
        let id = $(this).data('id');
        if (confirm('Are you sure you want to delete this profile?')) {
            $.ajax({
                url: baseUrl + 'profiling/delete/' + id,
                type: 'DELETE',
                data: {
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                success: function (response) {
                    if (response.success) {
                        table.ajax.reload();
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        }
    });
});
</script>
<?= $this->endSection() ?>