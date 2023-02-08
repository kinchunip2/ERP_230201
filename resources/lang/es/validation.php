<?php
return [
"required" => "Obligatorio",

"Required" => "Obligatorio",

"product_name.required" => "El campo de nombre de producto es necesario.",

"code.required" => "El campo de código es necesario.",

"product_type.required" => "El campo de tipo de producto es necesario.",

"product_name.string" => "El nombre del producto debe ser una serie.",

"product_type.string" => "El tipo de producto debe ser una serie.",

"variation_type.required_if" => "El campo de tipo de variación es necesario cuando el tipo de producto es Variable.",

"selected_product_id.required_if" => "El campo de ID de producto seleccionado es necesario cuando el tipo de producto es Combo.",

"employee_id.required_if" => "El campo de ID de empleado es necesario cuando el tipo de rol no es usuario del sistema.",

"username.numeric" => "El nombre de usuario debe ser un número.",

"email.required" => "El campo de correo electrónico es necesario.",

"email.unique" => "El correo electrónico ya ha sido tomado.",

"password.required" => "El campo de contraseña es necesario.",

"password.min" => "La contraseña debe tener al menos 8 caracteres.",

"department_id.required" => "El campo de ID de departamento es necesario.",

"department_id.numeric" => "El ID de departamento debe ser un número.",

"showroom_id.required" => "El campo de ID de sala de exposición es necesario.",

"showroom_id.numeric" => "El ID de showroom debe ser un número.",

"role_id.required" => "El campo de ID de rol es necesario.",

"current_address.required_if" => "El campo de dirección actual es necesario cuando el tipo de rol es usuario del sistema.",

"permanent_address.required_if" => "El campo de dirección permanente es necesario cuando el tipo de rol es usuario del sistema.",

"bank_name.required_if" => "El campo de nombre de banco es necesario cuando el tipo de rol es 1.",

"bank_branch_name.required_if" => "El campo de nombre de sucursal bancaria es necesario cuando el tipo de rol es usuario del sistema.",

"bank_account_name.required_if" => "El campo de nombre de cuenta bancaria es necesario cuando el tipo de rol es usuario del sistema.",

"bank_account_no.required_if" => "La cuenta bancaria no es necesaria cuando el tipo de rol es usuario del sistema.",

"date_of_joining.required_if" => "La fecha del campo de unión es necesaria cuando el tipo de rol es usuario del sistema.",

"basic_salary.required_if" => "El campo de salario básico es necesario cuando el tipo de rol es usuario del sistema.",

"employment_type.required_if" => "El campo de tipo de empleo es necesario cuando el tipo de rol es usuario del sistema.",

"photo.mimes" => "La foto debe ser un archivo de tipo: jpeg, jpg, png.",

"signature_photo.mimes" => "La foto de la firma debe ser un archivo de tipo: jpeg, jpg, png.",

"password.string" => "La contraseña debe ser una serie.",

"password.confirmed" => "La confirmación de contraseña no coincide.",

"name.required" => "El campo de nombre es necesario.",

"type.required" => "El campo de tipo es necesario.",

"status.required" => "El campo de estado es necesario.",

"date.required" => "El campo de fecha es necesario.",

"account_type.required" => "El campo de tipo de cuenta es necesario.",

"account_id.required" => "El campo de ID de cuenta es necesario.",

"narration.required" => "El campo de narración es necesario.",

"main_amount.required" => "El campo de cantidad principal es necesario.",

"main_amount.same" => "El importe principal y las subcantidades deben coincidir.",

"sub_amounts.required" => "El campo de subcantidades es necesario.",

"sub_narration.required" => "El campo de subnarración es necesario.",

"sub_account_id.required" => "El campo de ID de subcuenta es necesario.",

"sub_amount.required" => "El campo de subcantidad es necesario.",

"amount.required" => "El campo de cantidad es necesario.",

"attendance.required" => "El campo de asistencia es necesario.",

"year.required" => "El campo de año es necesario.",

"month.required" => "El campo de mes es necesario.",

"contact_type.required" => "El campo de tipo de contacto es necesario.",

"opening_balance.numeric" => "El saldo inicial debe ser un número.",

"pay_term_condition.string" => "La condición de término de pago debe ser una serie.",

"credit_limit.numeric" => "El límite de crédito debe ser un número.",

"alternate_contact_no.string" => "El contacto alternativo no debe ser una serie.",

"country_id.integer" => "El ID de país debe ser un entero.",

"state.string" => "El estado debe ser una serie.",

"city.string" => "La ciudad debe ser una cadena.",

"address.string" => "La dirección debe ser una serie.",

"note.string" => "La nota debe ser una serie.",

"mobile.string" => "El móvil debe ser una serie.",

"password_confirmation.required_with" => "El campo de confirmación de contraseña es necesario cuando la contraseña está presente.",

"name.unique" => "El nombre ya se ha tomado.",

"from.required" => "El campo from es necesario.",

"to.required" => "El campo to es necesario.",

"product_id.required" => "El campo de ID de producto es necesario.",

"leave_type_id.required" => "El campo de id de tipo de permiso es necesario.",

"reason.required" => "El campo de razón es necesario.",

"apply_date.required" => "El campo de fecha de aplicación es necesario.",

"start_date.required" => "El campo de fecha de inicio es necesario.",

"end_date.required" => "El campo de fecha de finalización es necesario.",

"end_date.date" => "La fecha de finalización no es una fecha válida.",

"end_date.after_or_equal" => "La fecha de finalización debe ser una fecha posterior o igual a la fecha de inicio.",

"code.unique" => "El código ya se ha tomado.",

"end_date.after" => "La fecha de finalización debe ser una fecha posterior a la fecha de inicio.",

"name.max" => "El nombre no puede tener más de 255 caracteres.",

"team_id.required" => "El campo de ID de equipo es necesario.",

"privacy.required" => "El campo de privacidad es necesario.",

"default_view.required" => "Es necesario el campo de vista predeterminado.",

"project_id.required" => "El campo de ID de proyecto es necesario.",

"project_id.integer" => "El ID de proyecto debe ser un entero.",

"description.string" => "La descripción debe ser una serie.",

"name.min" => "El nombre debe tener como mínimo 3 caracteres.",

"members.string" => "Los miembros deben ser una serie.",

"name.string" => "El nombre debe ser una serie.",

"supplier_id.required" => "El campo de ID de proveedor es necesario.",

"showroom.required" => "El campo showroom es necesario.",

"payment_method.required" => "El campo de método de pago es necesario.",

"ref_no.required" => "El campo ref no es necesario.",

"lc_no.required" => "No es necesario el campo lc.",

"lc_date.required" => "Es necesario el campo de fecha lc.",

"delivery_date.required" => "El campo de fecha de entrega es necesario.",

"payment_term.required" => "El campo de plazo de pago es necesario.",

"discount.required" => "El campo de descuento es necesario.",

"cnf_id.required" => "El campo de ID de cnf es necesario.",

"customer_id.required" => "El campo de ID de cliente es necesario.",

"warehouse_id.required" => "El campo de ID de almacén es necesario.",

"product_id.required_without_all" => "Seleccionar al menos un producto",

"customer.exists" => "El cliente seleccionado no es válido.",

"type.in" => "El tipo seleccionado no es válido.",

"title.required" => "El campo de título es necesario.",

"loan_type.required" => "El campo de tipo de préstamo es necesario.",

"total_month.required" => "El campo de mes total es necesario.",

"prefix.required" => "El campo de prefijo es necesario.",

"connection_type.required" => "El campo de tipo de conexión es necesario.",

"char_per_line.required" => "El campo char por línea es necesario.",

"ip.required" => "El campo ip es necesario.",

"path.required" => "El campo de vía de acceso es necesario.",

"port.required" => "El campo de puerto es necesario.",

"rate.required" => "El campo de tarifa es necesario.",

"current_password.required" => "El campo de contraseña actual es necesario.",

"current_password.string" => "La contraseña actual debe ser una serie.",

"phone.unique" => "El teléfono ya ha sido tomado.",

"bank_name.required" => "El campo de nombre de banco es necesario.",

"bank_name.unique" => "Ya se ha tomado el nombre del banco.",

"branch_name.required" => "El campo de nombre de rama es necesario.",

"account_no.required" => "La cuenta no es necesaria.",

"file.required" => "El campo de archivo es necesario.",

"file.mimes" => "El archivo debe ser un archivo de tipo: csv, xls, xlsx.",

"file.max" => "El archivo no puede ser mayor que 2048 kilobytes.",

"voucher_type.required" => "El campo de tipo de comprobante es necesario.",

"debit_account_id.required" => "El campo de ID de cuenta de débito es necesario.",

"debit_account_amount.required" => "Se requiere el campo de cantidad de cuenta de débito.",

"debit_account_narration.required" => "Se requiere el campo de narración de cuenta de débito.",

"debit_account_amount.*.required" => "El campo de cuenta de débito es necesario.",

"recovery_amount.required" => "El campo de cantidad de recuperación es necesario.",

"product.required" => "El campo de producto es necesario.",

"quantity.required" => "El campo de cantidad es necesario.",

"quantity*.required" => "El campo de cantidad * es necesario.",

"holiday_name.required" => "El campo de nombre de vacaciones es necesario.",

"date.required_if" => "El campo de fecha es necesario cuando el tipo es 0.",

"reason.max" => "La razón no puede tener más de 255 caracteres.",

"attachment.mimes" => "El archivo adjunto debe ser un archivo de tipo: jpeg, jep, png, docx, txt, pdf.",

"day.required" => "El campo de día es necesario.",

"from_day.required_if" => "El campo del día es necesario cuando el día es 0.",

"end_date.required_if" => "El campo de fecha de finalización es necesario cuando el día es 2.",

"max_forward.required_if" => "El campo máximo de reenvío es necesario cuando se comprueba el equilibrio hacia delante.",

"total_days.required" => "El campo de días totales es necesario.",

"id.required" => "El campo de ID es necesario.",

"native.required" => "El campo nativo es necesario.",

"translatable_file_name.required" => "El campo de nombre de archivo traducible es necesario.",

"key.required" => "El campo de clave es necesario.",

"code.max" => "El código no puede tener más de 15 caracteres.",

"native.max" => "El nativo no puede tener más de 50 caracteres.",

"all_product.required_without" => "El campo de todos los productos es necesario cuando las existencias no están presentes.",

"stocks.required_without" => "El campo de existencias es necesario cuando all_product no está presente.",

"amount.required_without_all" => "El campo de cantidad es necesario cuando no hay ninguno de payment_method.",

"payment_method.required_without_all" => "El campo de método de pago es necesario cuando no hay ninguna cantidad presente.",

"symbol.required" => "El campo de símbolo es necesario.",

"site_title.required" => "El campo de título del sitio es necesario.",

"site_title.string" => "El título del sitio debe ser una serie.",

"site_title.max" => "El título del sitio no puede tener más de 30 caracteres.",

"file_supported.string" => "El archivo soportado debe ser una serie.",

"copyright_text.string" => "El texto de copyright debe ser una cadena.",

"language_id.required" => "El campo de ID de idioma es necesario.",

"date_format_id.required" => "El campo de ID de formato de fecha es necesario.",

"currency_id.required" => "El campo de ID de moneda es necesario.",

"time_zone_id.required" => "El campo de ID de huso horario es necesario.",

"preloader.required" => "El campo de precargador es necesario.",

"site_logo.mimes" => "El logotipo del sitio debe ser un archivo de tipo: jpg, png, jpeg.",

"favicon_logo.mimes" => "El logotipo de faviconos debe ser un archivo de tipo: jpg, png, jpeg.",

"sms_gateway_id.required" => "El campo de ID de pasarela sms es necesario.",

"view.required" => "El campo de vista es necesario.",

"view.in" => "La vista seleccionada no es válida.",

"view.string" => "La vista debe ser una serie.",

"title.max" => "El título no puede tener más de 191 caracteres.",

"color_mode.required" => "El campo de modalidad de color es necesario.",

"color_mode.max" => "La modalidad de color no puede tener más de 191 caracteres.",

"is_default.required" => "El campo predeterminado es obligatorio.",

"is_default.boolean" => "El campo predeterminado debe ser true o false.",

"background_color.string" => "El color de fondo debe ser una serie.",

"background_color.max" => "El color de fondo no puede tener más de 20 caracteres.",

"background_color.required_if" => "El campo de color de fondo es necesario cuando el tipo de fondo es color.",

"background_image.required_if" => "El campo de imagen de fondo es necesario cuando el tipo de fondo es imagen.",

"background_image.mimes" => "La imagen de fondo debe ser un archivo de tipo: jpg, jpeg, png.",

"background_image.dimensions" => "La imagen de fondo tiene dimensiones de imagen no válidas.",

"color.*.required" => "El campo color.* es necesario.",

"color.*.string" => "El color.* debe ser una serie.",

"color.*.max" => "El color.* no puede tener más de 20 caracteres.",

"updateFile.required" => "El campo updateFile es necesario.",

"updateFile.mimes" => "UpdateFile debe ser un archivo de tipo: zip.",

"details.string" => "Los detalles deben ser una serie.",

];