$(document).ready(function () {
  // Check DNI
  $('#dni').on('input', function () {
    var dni = $(this).val();

    $.ajax({
      url: 'check_dni.php',
      method: 'POST',
      data: { dni: dni },
      success: function (response) {
        if (response.exists === true) {
          // NOTE: According to the statement I understand that if the DNI exists, I can request both a first appointment and a review
          $('#appointment_type').append(
            '<option value="Revisión">Revisión</option>'
          );
        } else {
          // If DNI doesn't exist, 'Revisión' is not available
          $('#appointment_type option[value="Revisión"]').remove();
        }
      }
    });
  });

  // Submit form
  $('#appointment_form').submit(function (event) {
    event.preventDefault();

    validateForm();

    $.ajax({
      url: 'save_appointment.php',
      method: 'POST',
      data: $(this).serialize(),
      success: function (response) {
        $('#msg').html(
          '<p class="' + response.class + '">' + response.msg + '</p>'
        );
      }
    });
  });

  // Note: Validate in html, js and php
  function validateForm() {
    const name = document.getElementById('name').value.trim();
    const dni = document.getElementById('dni').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const email = document.getElementById('email').value.trim();
    const appointmentType = document.getElementById('appointment_type').value;

    const validations = [
      {
        condition: name.length < 3,
        message: 'El nombre debe de tener al menos 3 caracteres.'
      },
      {
        condition: !/^\d{8}[A-Za-z]$/.test(dni),
        message: 'DNI debe de tener 8 caracteres seguidos de una letra.'
      },
      {
        condition: !/^\d{9}$/.test(phone),
        message: 'El número de teléfono debe de tener 9 dígitos.'
      },
      {
        condition: !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email),
        message: 'Formato de email inválido.'
      },
      {
        condition: !appointmentType,
        message: 'Por favor, selecciona un tipo de cita.'
      }
    ];

    for (const validation of validations) {
      if (validation.condition) {
        alert(validation.message);
        return;
      }
    }
  }
});
