# Old Onk School

sitio web dinámico de un estudio de tatuajes de estética _old school_. Incluye una parte pública (servicios, blog y solicitud de turno) y un panel de adminstración con autenticación propia.

> Trabajo práctico: **Portales y Comercio Electrónico – Primer Parcial**.
> Profesor: Santiago Gallino.
> Tecnologías: PHP, Laravel (versión actual), Blade, MySQL, CSS personalizado.

---

## 1. Consigna resumida

Web dinámica de tema libre (excepto política o religión) con blog/novedades y un servicio/producto para contratar. Se compone de dos partes:

### Sitio (usuarios comunes)

- [ ] Home que presente el estudio.
- [ ] Servicios que puedan contratar (sin carrito de compras).
- [ ] Sección de blog/novedades.

### Admin

- [ ] Autenticación **propia**. Está **prohibido** usar la interfaz de autenticación y los controllers que provee Laravel (Breeze, UI, Fortify, etc.).
- [ ] ABM de entradas del blog.

### Requisitos generales

- [ ] HTML con semántica y estructura correctas.
- [ ] CSS personalizado (se puede usar framework CSS).
- [ ] Vistas con **Blade**.
- [ ] Toda entrada de datos **validada en el servidor** y con errores informados (no se pude usar validación HTML).
- [ ] Mensaje de feedback al usuario (éxito, error, confirmación).
- [ ] Tablas y datos iniciales creados con **migrations y seeders**.
- [ ] POO aplicada, buenas prácticas de Laravel y **PHPDoc**.

---

## 2. Concepto del proyecto

**Nombre:** Old Ink School.

**Temática:** estudio de tatuaje de estilo tradicional (old school/american traditional): líneas gruesas, paleta limitada, flashes clásicos, etc.

**Servicio a contratar:** solicitud de turno para un servicio del estudio.

**Blog:** cuidado post-tatuaje, guía de estilos, mitos, novedades del estudio, flashes disponibles.

---

## 3. Mapa del sitio

### Sitio público

| Sección             | Descripción                                                                                          |
| ------------------- | ---------------------------------------------------------------------------------------------------- |
| Home                | Presentación del estudio, servicios destacados, últimos posts y llamado a la acción para pedir turno |
| Servicios           | Listado y detalle de cada servicio                                                                   |
| Blog                | Listado paginado, detalle por slug y filtro por categoría                                            |
| Solicitar turno     | Formulario con validaciones y feedback                                                               |
| Nosotros / Contacto | Opcional                                                                                             |

### Admin (protegido)

| Sección              | Descripción                                                   |
| -------------------- | ------------------------------------------------------------- |
| Login / logout       | Controller, vista y middleware propios                        |
| ABM de posts         | Listar, crear, editar y eliminar                              |
| ABM de servicios     | Extra que suma complejidad                                    |
| Solicitudes de turno | Listado y cambio de estado (pendiente, confirmado, cancelado) |

---

## 4. Modelo de datos (conceptual)

**Base de datos:** old_ink_school.

| Tabla               | Campos sugeridos                                                            | Relaciones                                        |
| ------------------- | --------------------------------------------------------------------------- | ------------------------------------------------- |
| `users`             | id, nombre, email, password                                                 | 1:N con `posts`                                   |
| `servicios`         | nombre, descripción, precio_base, duración_estimada, estilo, imagen, activo | 1:N con `solicitudes_turno`, N:M con `tatuadores` |
| `posts`             | título, slug, extracto, contenido, imagen, publicado, user_id               | N:1 con `users`, N:M con `categorias`             |
| `categorias`        | nombre, slug                                                                | N:M con `posts`                                   |
| `categoria_post`    | post_id, categoria_id                                                       | Tabla pivote                                      |
| `tatuadores`        | nombre, especialidad, bio, foto                                             | N:M con `servicios` (opcional)                    |
| `servicio_tatuador` | servicio_id, tatuador_id                                                    | Tabla pivote (opcional)                           |
| `solicitudes_turno` | servicio_id, nombre, email, teléfono, fecha_tentativa, mensaje, estado      | N:1 con `servicios`                               |

**Requisitos de la consigna que cumple:**

- Mínimo 3 tablas: `users`, `servicios` y `posts`.
- Al menos una tabla con 5+ campos (sin contar PK ni timestamps): `servicios` y `solicitudes_turno`.
- tablas de relación extra (suma nota): `categoria_post` y `servicio_tatuador`.

---

## 5. Indentidad visual

### Paleta de colores

| Rol                        | Color              | Hex       |
| -------------------------- | ------------------ | --------- |
| Principal (granate / vino) | Burdeos profundo   | `#6D1A2B` |
| Acento                     | Crema envejecido   | `#F2E6D0` |
| Fondo oscuro               | Negro tinta cálido | `#1A1416` |
| Detalle                    | Dorado apagado     | `#C9A24B` |
| Texto secundario           | Gris cálido        | `#8C7F7A` |

### Tipografía

**Titulo:** Rye.

**Cuerpo:** Source Sans 3.

| Rol    | Nombre        |
| ------ | ------------- |
| Titulo | Rye          |
| Cuerpo | Source Sans 3 |

---

## 6. Rutas previstas

### Públicas

| Método | URI                      | Descripción          |
| ------ | ------------------------ | -------------------- |
| GET    | `/`                      | Home                 |
| GET    | `/servicios`             | Listado de servicios |
| GET    | `/servicios/{id}`        | Detalle de servicio  |
| GET    | `/blog`                  | Listado de posts     |
| GET    | `/blog/categoria/{slug}` | Posts por categoría  |
| GET    | `/blog/{slug}`           | Detalle de post      |
| GET    | `/turnos/solicitar`      | Formulario de turno  |
| POST   | `/turnos`                | Enviar solicitud     |

### Admin

| Método | URI                  | Descripción                             |
| ------ | -------------------- | --------------------------------------- |
| GET    | `/admin/login`       | Formulario de login                     |
| POST   | `/admin/login`       | Autenticar                              |
| POST   | `/admin/logout`      | Cerrar sesión                           |
| —      | `/admin/posts`       | ABM de posts (protegido por middleware) |
| —      | `/admin/servicios`   | ABM de servicios (protegido)            |
| —      | `/admin/solicitudes` | Gestión de solicitudes (protegido)      |

---

## 7. Buenas prácticas a aplicar

- **Form Requests** para las validaciones.
- **Middleware propio** para proteger el admin.
- Lógica de negocio fuera de los controllers (**Principio de Responsabilidad Única**).
- **Route model binding** y slugs en las URLs del blog.
- Estados de publicación (borrador / publicado) en los posts.
- **Eloquent** con relaciones bien definidas.
- **PHPDoc** en clases y métodos desde el inicio.
- Nombres coherentes de variables, clases y métodos.
- HTML semántico: `header`, `nav`, `main`, `section`, `article`, `figure`, `footer`.
- Carpeta del proyecto prolija.

---

## 8. Uso de IA

La consigna **no permite** desarrollar la entrega con modelos generativos. Solo se admite un uso limitado en partes que no son el foco (diseño, estructura semántica). El alumno debe poder:

- Responder preguntas sobre el código y las funciones.
- Justificar las decisiones de diseño e implementación.
- Explicar la teoría de la materia y de materias relacionadas (HTML, CSS).

---

## 9. Modalidad de entrega

- Archivo: `apellido-nombre.zip` (o `.rar`), por ejemplo `perez-juan.zip`.
- Debe contener el **proyecto completo** y un archivo `datos.txt` con:
    - Carrera
    - Materia
    - Cuatrimestre
    - Año
    - Turno
    - Comisión
    - Apellido y nombre
    - Docente
    - Carácter de entrega: **1er parcial**
- El incumplimiento de las condiciones de entrega puede restar **al menos 1 punto**.
- Puede haber preguntas orales o teóricas para aprobar.
