 <div class="row">
     <div class="col-md-12">

         <div class="card">
             <div class="card-header">
                 <h5 class="card-title">Update Data Profil</h5>
             </div>
             <?php echo form_open('user/update'); ?>
             <div class="card-body">
                 <div class="form-group row">
                     <label class="col-form-label col-md-2">Nama Lengkap</label>
                     <div class="col-md-10">
                         <input type="text" class="form-control" value="<?= $dataId['name']; ?>">
                     </div>
                 </div>
                 <div class="form-group row">
                     <label class="col-form-label col-md-2">Email</label>
                     <div class="col-md-10">
                         <input type="text" class="form-control" value="<?= $dataId['email']; ?>">
                     </div>
                 </div>
                 <div class="form-group row">
                     <label class="col-form-label col-md-2">Password</label>
                     <div class="col-md-10">
                         <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#updatePass">Klik Untuk Update Password</button>
                     </div>
                 </div>
             </div>
             <div class="card-footer">
                 <a href="<?= base_url('user');?>" class="btn btn-sm btn-secondary">Kembali</a>
                 <button class="btn btn-sm btn-primary" type="submit">Update</button>
             </div>
             <?php echo form_close() ?>
         </div>
     </div>
     <div class="col-md-6" hidden>
         <div class="card">
             <div class="card-header">
                 <h5 class="card-title">Small Select2</h5>
             </div>
             <div class="card-body">
                 <div class="row">
                     <div class="col-md-12">
                         <p>Use data('select2') function to get container of select2.</p>
                         <select class="form-control form-small select">
                             <option selected="selected">orange</option>
                             <option>white</option>
                             <option>purple</option>
                         </select>
                     </div>
                 </div>
             </div>
         </div>
         <div class="card">
             <div class="card-header">
                 <h5 class="card-title">Disabling options</h5>
             </div>
             <div class="card-body">
                 <div class="row">
                     <div class="col-md-12">
                         <p>Disable Select using disabled attribute.</p>
                         <select class="form-control disabled-results">
                             <option value="one">First</option>
                             <option value="two" disabled="disabled">Second</option>
                             <option value="three">Third</option>
                         </select>
                     </div>
                 </div>
             </div>
         </div>
         <div class="card">
             <div class="card-header">
                 <h5 class="card-title">Limiting the number of Tagging</h5>
             </div>
             <div class="card-body">
                 <div class="row">
                     <div class="col-md-12">
                         <p>Set maximumSelectionLength: 2 with tags: true to limit selectin in Tag mode.</p>
                         <select class="form-control tagging" multiple="multiple">
                             <option>orange</option>
                             <option>white</option>
                             <option>purple</option>
                         </select>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="updatePass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Update Password</h4>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <?php echo form_open('pengawasan/store_dt_umum'); ?>
             <div class="modal-body p-4">
                 <div>
                     <label for="current_password">Current Password</label>
                     <div class="input-group">
                         <input class="form-control" type="password" name="current_password" id="current_password" required>
                         <button type="button" class="input-group-text btn btn-sm btn-secondary" id="current_password-toggle" onclick="togglePasswordVisibility('current_password')">Show</button>
                     </div>
                 </div>

                 <div>
                     <label for="new_password">New Password</label>
                     <div class="input-group">
                         <input class="form-control" type="password" name="new_password" id="new_password" required>
                         <button type="button" class="input-group-text btn btn-sm btn-secondary" id="new_password-toggle" onclick="togglePasswordVisibility('new_password')">Show</button>
                     </div>
                 </div>

                 <div>
                     <label for="confirm_password">Confirm New Password</label>
                     <div class="input-group">
                         <input class="form-control" type="password" name="confirm_password" id="confirm_password" required>
                         <button type="button" class="input-group-text btn btn-sm btn-secondary" id="confirm_password-toggle" onclick="togglePasswordVisibility('confirm_password')">Show</button>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button class="btn btn-sm btn-primary" type="submit">Update Password</button>

             </div>
             <?php echo form_close(); ?>
         </div>
     </div>
 </div>