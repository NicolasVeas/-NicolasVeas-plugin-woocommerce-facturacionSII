
Tabla dte_credentials:

Propósito: Almacenar las credenciales y tokens necesarios para autenticarse con la API de Riosoft.
Columnas:
id: Identificador único para la entrada.
email: Correo electrónico utilizado para la autenticación.
token: Token de acceso proporcionado por la API.
token_type: Tipo de token proporcionado por la API.
expires_in: Duración de la validez del token.
issued_at: Tiempo en el que se emitió el token.
client_id: ID del cliente proporcionado por la API.
refresh_token: Token de actualización proporcionado por la API.
created_at, updated_at: Fechas de creación y última actualización de la entrada.
Tabla dte_emisores:

Propósito: Almacenar información del emisor que será constante en todos los DTEs.
Columnas:
id: Identificador único para la entrada.
rut, razon_social, direccion_origen, comuna_origen, giro, sucursal, ciudad_origen: Datos del emisor.
actecos: Actividades económicas del emisor.
created_at, updated_at: Fechas de creación y última actualización de la entrada.
Tabla dte_receptores:

Propósito: Almacenar información de los receptores, permitiendo la reutilización de datos en futuras compras.
Columnas:
id: Identificador único para la entrada.
rut, nombre, direccion, ciudad, email: Datos del receptor.
created_at, updated_at: Fechas de creación y última actualización de la entrada.
Tabla dtes:

Propósito: Almacenar información sobre los DTEs creados.
Columnas:
id: Identificador único para la entrada.
document_id, document_type, document_number: Datos del DTE.
status: Estado del DTE (ej. Firmado, Enviado, etc.).
document_date: Fecha de emisión del DTE.
created_at, updated_at: Fechas de creación y última actualización de la entrada.
Tabla dte_envios:

Propósito: Almacenar información sobre los envíos de DTEs a la API y al SII.
Columnas:
id: Identificador único para la entrada.
folio: Folio del envío.
sending_status, effective_status: Estados del envío y del procesamiento efectivo.
effective_date: Fecha de procesamiento efectivo.
created_at, updated_at: Fechas de creación y última actualización de la entrada.

Dame el archivo final de db-setup.php prefiero tener todo en text, así lo almaceno como string, ok?