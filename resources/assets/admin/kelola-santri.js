/**
 * Datatables Pengguna
 */

'use strict';

// Datatable (jquery)
$(function () {
  // Variable declaration for table
  var dt_user_table = $('.table-santri');
  // ajax setup
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // Pengguna datatable
  if (dt_user_table.length) {
    var dt_user = dt_user_table.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: baseUrl + 'santri-list'
      },
      columns: [
        // columns according to JSON
        { data: 'id' },
        { data: 'id' },
        { data: 'id' },
        { data: 'no_identitas' },
        { data: 'nama_lengkap' },
        { data: 'alamat' },
        { data: 'keterangan' },
        { data: 'status' },
        { data: 'created_at' },
        { data: 'action' }
      ],
      columnDefs: [
        {
          // For Checkboxes
          targets: 0,
          orderable: false,
          render: function render(data, type, full, meta) {
            var $idnya = full['id'];
            return '<input type="checkbox" class="dt-checkboxes form-check-input" data-id="' + $idnya + '">';
          },
          checkboxes: {
            selectAllRender: '<input type="checkbox" class="form-check-input">'
          },
          responsivePriority: 4
        },
        {
          searchable: false,
          orderable: false,
          targets: 1,
          render: function (data, type, full, meta) {
            return `<span>${full.fake_id}</span>`;
          }
        },
        {
          // User ID
          targets: 2,
          render: function (data, type, full, meta) {
            var $id = full['id'];

            return (
              '<a href="/admin/detail-santri/' +
              $id +
              '" class="user-id btn btn-sm btn-label-primary" style="width:130px;">Detail Santri</a>'
            );
          }
        },
        {
          // User no_identitas
          targets: 3,
          render: function (data, type, full, meta) {
            var $no_identitas = full['no_identitas'];

            return '<span class="user-no_identitas">' + $no_identitas + '</span>';
          }
        },
        {
          // User nama_lengkap
          targets: 4,
          render: function (data, type, full, meta) {
            var $nama_lengkap = full['nama_lengkap'];

            return '<span class="user-nama_lengkap">' + $nama_lengkap + '</span>';
          }
        },
        {
          // User alamat
          targets: 5,
          render: function (data, type, full, meta) {
            var $alamat = full['alamat'];

            return '<span class="user-alamat">' + $alamat + '</span>';
          }
        },
        {
          // User keterangan
          targets: 6,
          render: function (data, type, full, meta) {
            var $keterangan = full['keterangan'];

            return '<span class="user-keterangan">' + $keterangan + '</span>';
          }
        },
        {
          // User status
          targets: 7,
          render: function (data, type, full, meta) {
            var $status = full['status'];

            if ($status == 0) {
              return '<span class="badge bg-success">Aktif</span>';
            } else if ($status == 1) {
              return '<span class="badge bg-primary">Lulus</span>';
            } else {
              return '<span class="badge bg-secondary">Unknown</span>'; // jika statusnya selain 1 atau 0
            }
          }
        },
        {
          // User created_at
          targets: 8,
          render: function (data, type, full, meta) {
            var $created_at = full['created_at'];

            return '<span class="user-created_at">' + $created_at + '</span>';
          }
        },
        {
          // Actions
          targets: -1,
          title: 'Actions',
          searchable: false,
          orderable: false,
          render: function render(data, type, full, meta) {
            return (
              '<div class="d-flex flex-row">' +
              // Tombol Hapus
              '<button class="btn btn-sm btn-danger delete-record" data-id="' +
              full['id'] +
              '" data-bs-toggle="modal" data-bs-target="#modalHapus"><i class="ti ti-trash me-2"></i>Hapus</button>' +
              // Tombol Edit
              '<button class="btn btn-sm btn-primary ms-2 edit-record" data-id="' +
              full['id'] +
              '" data-bs-toggle="modal" data-bs-target="#modalEditData"><i class="ti ti-pencil me-2"></i>Edit</button>' +
              '</div>'
            );
          }
        }
      ],
      order: [[2, 'desc']],
      dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      language: {
        url: 'datatables_id.json',
        sLengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Cari HP...',
        info: 'Displaying _START_ to _END_ of _TOTAL_ entries',
        paginate: {
          next: '<i class="ti ti-chevron-right ti-sm"></i>',
          previous: '<i class="ti ti-chevron-left ti-sm"></i>'
        }
      }
    });
  }

  if ($('#pilihPengguna').length) {
    var $pilihPengguna = $('#pilihPengguna');

    $pilihPengguna.wrap('<div class="position-relative"></div>').select2({
      placeholder: 'Pilih Beberapa Pengguna',
      dropdownParent: $pilihPengguna.parent(),
      ajax: {
        url: '/admin/select-pengguna', // route untuk mendapatkan data pengguna
        type: 'GET',
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            q: params.term // request parameter pencarian
          };
        },
        processResults: function (data) {
          return {
            results: data.map(function (user) {
              return { id: user.id, text: user.nama_lengkap };
            })
          };
        },
        cache: true
      }
    });
  }

  // Edit record
  $(document).on('click', '.edit-record', function () {
    var user_id = $(this).data('id'),
      dtrModal = $('.dtr-bs-modal.show');

    // hide responsive modal in small screen
    if (dtrModal.length) {
      dtrModal.modal('hide');
    }

    // get data
    $.get(''.concat(baseUrl, 'santri-list/').concat(user_id, '/edit'), function (data) {
      $('#id').val(data.id);
      $('#no_identitas').val(data.no_identitas);
      $('#nama_lengkap').val(data.nama_lengkap);
      $('#alamat').val(data.alamat);
      $('#tgl_lahir').val(data.tgl_lahir);
      $('#jenis_kelamin').val(data.jenis_kelamin);
      $('#keterangan').val(data.keterangan);
      $('#status').val(data.status);
      $('#nama_wali_ayah').val(data.nama_wali_ayah);
      $('#telepon_wali_ayah').val(data.telepon_wali_ayah);
      $('#alamat_wali_ayah').val(data.alamat_wali_ayah);
      $('#nama_wali_ibu').val(data.nama_wali_ibu);
      $('#telepon_wali_ibu').val(data.telepon_wali_ibu);
      $('#alamat_wali_ibu').val(data.alamat_wali_ibu);
    });
    
    // validating form and updating user's data
    var editData = document.getElementById('editData');

    // user form validation
    var fv = FormValidation.formValidation(editData, {
      fields: {
        no_identitas: {
          validators: {
            notEmpty: {
              message: '*Wajib Diisi'
            }
          }
        },
        nama_lengkap: {
          validators: {
            notEmpty: {
              message: '*Wajib Diisi'
            }
          }
        },
        alamat: {
          validators: {
            notEmpty: {
              message: '*Wajib Diisi'
            }
          }
        },
        status: {
          validators: {
            notEmpty: {
              message: '*Wajib Diisi'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          eleValidClass: '',
          rowSelector: function rowSelector(field, ele) {
            // field is the field name & ele is the field element
            return '.fieldnya';
          }
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        // Submit the form when all fields are valid
        // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        autoFocus: new FormValidation.plugins.AutoFocus()
      }
    }).on('core.form.valid', function () {
      // adding or updating user when form successfully validate
      $.ajax({
        data: $('#editData').serialize(),
        url: ''.concat(baseUrl, 'santri-list'),
        type: 'POST',
        success: function success(response) {
          // sweetalert
          Swal.fire({
            icon: 'success',
            title: 'Sip, Berhasil',
            text: 'Data pengguna berhasil '.concat(response.status === 'created' ? 'dibuat' : 'diupdate'),
            customClass: {
              confirmButton: 'btn btn-success'
            }
          }).then(result => {
            if (result.isConfirmed) {
              window.location.reload();
            }
          });
        },
        error: function error(err) {
          const errorResponse = err.responseJSON || {};

          Swal.fire({
            title: 'Yah, Gagal',
            text: errorResponse.message || 'Terjadi kesalahan.',
            icon: 'error',
            customClass: {
              confirmButton: 'btn btn-success'
            }
          }).then(result => {
            if (result.isConfirmed) {
              window.location.reload();
            }
          });
        }
      });
    });
  });

  // Delete Record
  $(document).on('click', '.delete-record', function () {
    var user_id = $(this).data('id'),
      dtrModal = $('.dtr-bs-modal.show');

    // hide responsive modal in small screen
    if (dtrModal.length) {
      dtrModal.modal('hide');
    }

    // sweetalert for confirmation of delete
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: 'Anda tidak dapat mengembalikan data ini nantinya !',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus!',
      customClass: {
        confirmButton: 'btn btn-primary me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {
        // delete the data
        $.ajax({
          type: 'DELETE',
          url: ''.concat(baseUrl, 'santri-list/').concat(user_id),
          success: function success() {
            dt_user.draw();
          },
          error: function error(_error) {
            console.log(_error);
          }
        });

        // success sweetalert
        Swal.fire({
          icon: 'success',
          title: 'Sip, Terhapus!',
          text: 'Santri berhasil dihapus!',
          customClass: {
            confirmButton: 'btn btn-success'
          }
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: 'Dibatalkan',
          text: 'Santri tidak jadi dihapus!',
          icon: 'error',
          customClass: {
            confirmButton: 'btn btn-success'
          }
        });
      }
    });
  });

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});

document.addEventListener('DOMContentLoaded', function () {
  const userForm = document.getElementById('userForm');

  userForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Mencegah form submit default

    const formData = new FormData(userForm);

    fetch(userForm.action, {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
      }
    })
      .then(response => {
        if (!response.ok) {
          return response.json().then(data => {
            // Jika ada error validasi, tangkap error dari 'errors'
            if (data.errors) {
              let errorMessages = '';
              for (const [field, messages] of Object.entries(data.errors)) {
                messages.forEach(message => {
                  errorMessages += `${message}<br>`;
                });
              }
              throw new Error(errorMessages);
            }
            throw new Error(data.message || 'Terjadi kesalahan.');
          });
        }
        console.log(response);
        return response.json();
      })
      .then(data => {
        // Tampilkan SweetAlert untuk success
        Swal.fire({
          icon: 'success',
          title: 'Sip, Berhasil !',
          text: data.message,
          customClass: {
            confirmButton: 'btn btn-success'
          }
        }).then(() => {
          location.reload();
          console.log(data);
        });
      })
      .catch(error => {
        // Tampilkan SweetAlert untuk error
        Swal.fire({
          icon: 'error',
          title: 'Yah, Gagal',
          html: error.message, // Gunakan 'html' agar pesan error berformat HTML (termasuk <br>)
          customClass: {
            confirmButton: 'btn btn-danger'
          }
        });
      });
  });
});
